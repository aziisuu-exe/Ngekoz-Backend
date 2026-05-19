<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\KosPlace;
use Illuminate\Http\Request;

class KosVerificationController extends Controller
{
    public function unverifiedKos()
    {
        $kos = KosPlace::with(['owner', 'photos'])
            ->where('is_verified', false)
            ->latest()
            ->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Daftar kos yang menunggu verifikasi',
            'data' => $kos
        ], 200);
    }

    public function verify($id)
    {
        $kos = KosPlace::findOrFail($id);

        if ($kos->is_verified) {
            return response()->json([
                'status' => 'error',
                'message' => 'Kos ini sudah diverifikasi sebelumnya.'
            ], 400);
        }

        $kos->update(['is_verified' => true]);

        return response()->json([
            'status' => 'success',
            'message' => 'Kos berhasil diverifikasi dan sekarang tampil di pencarian publik.',
            'data' => $kos
        ], 200);
    }
}