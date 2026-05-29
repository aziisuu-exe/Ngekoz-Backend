<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use Illuminate\Http\Request;

class FacilityController extends Controller
{
    public function index(Request $request)
    {
        $query = Facility::query();

        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'LIKE', "%{$request->search}%");
        }

        return response()->json([
            'success' => true,
            'data' => $query->orderBy('id', 'asc')->get()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:facilities,name|max:255',
            'icon_name' => 'nullable|string|max:50'
        ]);

        $facility = Facility::create([
            'name' => $request->name,
            'icon_name' => $request->icon_name
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Fasilitas berhasil ditambahkan',
            'data' => $facility
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:facilities,name,' . $id,
            'icon_name' => 'nullable|string|max:50'
        ]);

        $facility = Facility::findOrFail($id);
        $facility->update([
            'name' => $request->name,
            'icon_name' => $request->icon_name
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Fasilitas berhasil diperbarui',
            'data' => $facility
        ]);
    }

    public function destroy($id)
    {
        $facility = Facility::findOrFail($id);
        $facility->delete();

        return response()->json([
            'success' => true,
            'message' => 'Fasilitas berhasil dihapus'
        ]);
    }
}