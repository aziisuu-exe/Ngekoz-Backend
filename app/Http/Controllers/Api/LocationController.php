<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\District;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function getCities(Request $request)
    {
        $query = City::withCount('districts'); 

        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'LIKE', "%{$request->search}%");
        }

        return response()->json([
            'success' => true,
            // Mengubah paginate menjadi get() agar semua data dikirim ke frontend
            'data' => $query->orderBy('id', 'asc')->get()
        ]);
    }

    public function getDistricts(Request $request)
    {
        $query = District::with('city'); 

        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'LIKE', "%{$request->search}%");
        }

        return response()->json([
            'success' => true,
            // Mengubah paginate menjadi get() agar semua data dikirim ke frontend
            'data' => $query->orderBy('id', 'asc')->get()
        ]);
    }

    public function storeCity(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:cities,name|max:255'
        ]);

        $city = City::create(['name' => $request->name]);

        return response()->json([
            'success' => true,
            'message' => 'Kota berhasil ditambahkan',
            'data' => $city
        ]);
    }

    public function getAllCities()
    {
        return response()->json([
            'success' => true,
            'data' => City::orderBy('name', 'asc')->get()
        ]);
    }

    public function storeDistrict(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'city_id' => 'required|exists:cities,id' 
        ]);

        $district = District::create([
            'name' => $request->name,
            'city_id' => $request->city_id
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Kecamatan berhasil ditambahkan',
            'data' => $district
        ]);
    }

    public function updateDistrict(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'city_id' => 'required|exists:cities,id'
        ]);

        $district = District::findOrFail($id);
        $district->update([
            'name' => $request->name,
            'city_id' => $request->city_id
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Kecamatan berhasil diperbarui',
            'data' => $district
        ]);
    }

    public function destroyDistrict($id)
    {
        $district = District::findOrFail($id);
        $district->delete();

        return response()->json([
            'success' => true,
            'message' => 'Kecamatan berhasil dihapus'
        ]);
    }
}