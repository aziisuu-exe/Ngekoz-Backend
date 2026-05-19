<?php

namespace App\Http\Controllers\Api\Owner;

use App\Http\Controllers\Controller;
use App\Models\KosPlace;
use App\Models\Photo;
use App\Models\Owner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Cloudinary\Cloudinary;

class KosController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'district_id' => 'required|exists:districts,id',
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'type' => 'required|in:Putra,Putri,Campur',
            'price_start_from' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'rules' => 'nullable|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'photo_type_id' => 'required|exists:photo_types,id'
        ]);

        $user = $request->user();
        
        $owner = Owner::where('user_id', $user->id)->first();
        if (!$owner) {
            return response()->json([
                'status' => 'error',
                'message' => 'Profil owner tidak ditemukan.'
            ], 403);
        }

        DB::beginTransaction();

        try {
            // 1. Simpan Data Kos
            $kosPlace = KosPlace::create([
                'owner_id' => $owner->id,
                'district_id' => $request->district_id,
                'name' => $request->name,
                'address' => $request->address,
                'type' => $request->type,
                'price_start_from' => $request->price_start_from,
                'description' => $request->description,
                'rules' => $request->rules,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'is_verified' => false,
            ]);

            // 2. Proses Upload Gambar ke Cloudinary
            if ($request->hasFile('image')) {
                // Inisialisasi Cloudinary menggunakan URL dari .env
                $cloudinary = new Cloudinary(env('CLOUDINARY_URL'));
                
                // Upload gambar ke folder 'ngekoz_photos'
                $uploadResult = $cloudinary->uploadApi()->upload(
                    $request->file('image')->getRealPath(),
                    ['folder' => 'ngekoz_photos']
                );

                Photo::create([
                    'kos_place_id' => $kosPlace->id,
                    'photo_type_id' => $request->photo_type_id,
                    'image_url' => $uploadResult['secure_url'], // Ambil URL aman (https) dari Cloudinary
                    'caption' => 'Foto utama ' . $kosPlace->name,
                    'is_primary' => true,
                ]);
            }

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Data kos berhasil ditambahkan dan menunggu verifikasi.',
                'data' => $kosPlace->load('photos')
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat menyimpan data.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}