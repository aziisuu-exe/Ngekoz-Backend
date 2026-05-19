<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\KosPlace;
use Illuminate\Http\Request;

class KosPlaceController extends Controller
{
    public function index(Request $request)
    {
        $query = KosPlace::with(['district.city', 'owner']); 

        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'LIKE', "%{$request->search}%")
                  ->orWhere('address', 'LIKE', "%{$request->search}%");
        }

        return response()->json([
            'success' => true,
            'data' => $query->orderBy('id', 'desc')->paginate(10)
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'owner_id' => 'required|integer',
            'district_id' => 'required|integer|exists:districts,id',
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'type' => 'required|string|in:Putra,Putri,Campur',
            'price_start_from' => 'required|numeric',
            'description' => 'nullable|string',
            'latitude' => 'nullable|string|max:50',
            'longitude' => 'nullable|string|max:50',
            // is_verified 
        ]);

        $kosPlace = KosPlace::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Properti kos berhasil ditambahkan',
            'data' => $kosPlace
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'owner_id' => 'required|integer',
            'district_id' => 'required|integer|exists:districts,id',
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'type' => 'required|string|in:Putra,Putri,Campur',
            'price_start_from' => 'required|numeric',
            'description' => 'nullable|string',
            'latitude' => 'nullable|string|max:50',
            'longitude' => 'nullable|string|max:50',
            'is_verified' => 'boolean' 
        ]);

        $kosPlace = KosPlace::findOrFail($id);
        $kosPlace->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Properti kos berhasil diperbarui',
            'data' => $kosPlace
        ]);
    }

    public function destroy($id)
    {
        $kosPlace = KosPlace::findOrFail($id);
        $kosPlace->delete();

        return response()->json([
            'success' => true,
            'message' => 'Properti kos berhasil dihapus'
        ]);
    }
}