<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WebhookController extends Controller
{
    public function xenditCallback(Request $request)
    {
        $externalId = $request->external_id;
        $status = $request->status; 

        $xenditToken = env('XENDIT_WEBHOOK_TOKEN');
        if ($request->header('x-callback-token') !== $xenditToken) {
            return response()->json([
                'status' => 'error',
                'message' => 'Akses ditolak.'
            ], 403);
        }

        $payment = Payment::where('external_id', $externalId)->first();

        if ($payment) {
            DB::beginTransaction();
            try {
                if ($status === 'PAID') {
                    $payment->update(['status' => 'paid']);
                    Booking::where('id', $payment->booking_id)->update(['status' => 'paid']);
                    
                } elseif ($status === 'EXPIRED') {
                    $payment->update(['status' => 'expired']);
                    $booking = Booking::where('id', $payment->booking_id)->first();
                    $booking->update(['status' => 'cancelled']);
                    
                    Room::where('id', $booking->room_id)->update(['is_available' => true]);
                }
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json(['message' => 'Gagal memproses callback'], 500);
            }
        }

        return response()->json(['message' => 'Callback processed successfully'], 200);
    }
}