<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'start_date' => 'required|date',
            'duration_months' => 'required|integer|min:1'
        ]);

        $user = $request->user();
        $room = \App\Models\Room::with('kosPlace')->findOrFail($request->room_id);

        if (!$room->is_available) {
            return response()->json(['message' => 'Kamar tidak tersedia'], 400);
        }

        $roomPrice = $room->price_custom ?? $room->kosPlace->price_start_from;
        $totalPrice = (int) $roomPrice * (int) $request->duration_months;
        $externalId = 'NGEKOZ-' . time() . '-' . Str::random(5);

        $xenditResponse = Http::withBasicAuth(env('XENDIT_SECRET_KEY'), '')
            ->post('https://api.xendit.co/v2/invoices', [
                'external_id' => $externalId,
                'amount' => $totalPrice,
                'payer_email' => $user->email,
                'description' => 'Pembayaran Sewa: ' . $room->kosPlace->name . ' (' . $request->duration_months . ' Bulan)',
                'success_redirect_url' => 'http://localhost:3000/success', 
                'failure_redirect_url' => 'http://localhost:3000/failed',
            ]);

        if ($xenditResponse->failed()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal membuat tagihan pembayaran ke Xendit.',
                'error' => $xenditResponse->json()
            ], 500);
        }

        $invoiceUrl = $xenditResponse->json()['invoice_url'];

        DB::beginTransaction();

        try {
            $booking = \App\Models\Booking::create([
                'user_id' => $user->id,
                'room_id' => $room->id,
                'start_date' => $request->start_date,
                'duration_months' => $request->duration_months,
                'total_price' => $totalPrice, 
                'status' => 'pending'
            ]);

           
            \App\Models\Payment::create([
                'booking_id' => $booking->id,
                'external_id' => $externalId, 
                'amount' => $totalPrice,
                'payment_url' => $invoiceUrl,
                'payment_method' => 'xendit_invoice',
                'status' => 'pending'
            ]);

            $room->update(['is_available' => false]);

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Booking berhasil dibuat.',
                'invoice_url' => $invoiceUrl 
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    public function myBookings(Request $request)
    {
        $bookings = Booking::with(['room.kosPlace', 'payments'])
            ->where('user_id', $request->user()->id)
            ->latest()
            ->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Data riwayat booking berhasil diambil',
            'data' => $bookings
        ], 200);
    }

    public function show(Request $request, $id)
    {
        $booking = Booking::with(['room.kosPlace', 'payments'])
            ->where('id', $id)
            ->where('user_id', $request->user()->id) 
            ->first();

        if (!$booking) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data booking tidak ditemukan atau Anda tidak memiliki akses.'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $booking
        ], 200);
    }
}