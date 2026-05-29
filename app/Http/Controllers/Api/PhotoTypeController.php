<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PhotoType; 
use Illuminate\Http\Request;

class PhotoTypeController extends Controller
{
    public function index(Request $request)
    {
        $query = PhotoType::query();

        if ($request->has('search') && $request->search != '') {
            $query->where('type_name', 'LIKE', "%{$request->search}%");
        }

        return response()->json([
            'success' => true,
            'data' => $query->orderBy('id', 'asc')->get()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'type_name' => 'required|string|max:255|unique:photo_types,type_name'
        ]);

        $photoType = PhotoType::create(['type_name' => $request->type_name]);

        return response()->json([
            'success' => true,
            'message' => 'Tipe foto berhasil ditambahkan',
            'data' => $photoType
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'type_name' => 'required|string|max:255|unique:photo_types,type_name,' . $id
        ]);

        $photoType = PhotoType::findOrFail($id);
        $photoType->update(['type_name' => $request->type_name]);

        return response()->json([
            'success' => true,
            'message' => 'Tipe foto berhasil diperbarui',
            'data' => $photoType
        ]);
    }

    public function destroy($id)
    {
        $photoType = PhotoType::findOrFail($id);
        $photoType->delete();

        return response()->json([
            'success' => true,
            'message' => 'Tipe foto berhasil dihapus'
        ]);
    }
}