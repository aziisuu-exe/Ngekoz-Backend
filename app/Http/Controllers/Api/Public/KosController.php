<?php

namespace App\Http\Controllers\Api\Public;

use App\Http\Controllers\Controller;
use App\Models\KosPlace;
use Illuminate\Http\Request;

class KosController extends Controller
{
    public function index(Request $request)
    {
        // 1. Query Dasar: Hanya ambil kos yang SUDAH diverifikasi
        // Beserta relasi distrik (kecamatan), kota, foto utama, dan fasilitas
        $query = KosPlace::with(['district.city', 'facilities', 'photos' => function ($q) {
                $q->where('is_primary', true); // Hanya load foto utama untuk efisiensi
            }])
            ->where('is_verified', true);

        // 2. Filter Berdasarkan Keyword (Nama Kos atau Alamat)
        $query->when($request->keyword, function ($q, $keyword) {
            $q->where(function ($subQ) use ($keyword) {
                $subQ->where('name', 'like', "%{$keyword}%")
                     ->orWhere('address', 'like', "%{$keyword}%");
            });
        });

        // 3. Filter Berdasarkan Tipe (Putra / Putri / Campur)
        $query->when($request->type, function ($q, $type) {
            $q->where('type', $type);
        });

        // 4. Filter Berdasarkan Harga Maksimal
        $query->when($request->max_price, function ($q, $max_price) {
            $q->where('price_start_from', '<=', $max_price);
        });

        // 5. Filter Berdasarkan Kota (Opsional)
        $query->when($request->city_id, function ($q, $city_id) {
            $q->whereHas('district', function ($subQ) use ($city_id) {
                $subQ->where('city_id', $city_id);
            });
        });

        // 6. Eksekusi Query dan Pagination (10 data per halaman)
        $kosPlaces = $query->latest()->paginate(10);

        return response()->json([
            'status' => 'success',
            'message' => 'Data kos berhasil diambil',
            'data' => $kosPlaces
        ], 200);
    }
}