<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\KosPlace;
use Illuminate\Http\Request;
use App\Http\Resources\Api\KosPlaceResource;

class KosPlaceController extends Controller
{
    public function index(Request $request)
    {
        $query = KosPlace::with([
            'district.city',
            'photos' => fn($q) => $q->where('is_primary', true),
            'facilities'
        ])->where('is_verified', true);

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('address', 'like', '%' . $request->search . '%');
            });
        }

        $kosPlaces = $query->latest()->paginate(10);

        return response()->json([
            'status' => 'success',
            'message' => 'Data daftar kos berhasil diambil',
            'data' => KosPlaceResource::collection($kosPlaces),
            'meta' => [
                'current_page' => $kosPlaces->currentPage(),
                'last_page' => $kosPlaces->lastPage(),
                'total' => $kosPlaces->total(),
            ]
        ], 200);
    }

    public function show($id)
    {
        $kosPlace = KosPlace::with([
            'owner.user',
            'district.city',
            'photos',
            'facilities',
            'rooms',
            'reviews.user'
        ])->find($id);

        if (!$kosPlace) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data kos tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Data detail kos berhasil diambil',
            'data' => $kosPlace
        ], 200);
    }
}