<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\KosPlace;
use Illuminate\Http\Request;

class ManageKosController extends Controller
{
    public function index()
    {
        $kos = KosPlace::with(['owner', 'district.city'])->latest()->paginate(15);

        return response()->json([
            'status' => 'success',
            'message' => 'Daftar seluruh kos berhasil diambil',
            'data' => $kos
        ], 200);
    }

    public function destroy($id)
    {
        $kos = KosPlace::findOrFail($id);
        $kos->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Data Kos berhasil dihapus secara permanen.'
        ], 200);
    }
}