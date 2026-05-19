<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Owner;
use App\Models\User;
use Illuminate\Http\Request;

class OwnerController extends Controller
{
    public function index(Request $request)
    {
        $query = Owner::with('user'); 

        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'LIKE', "%{$request->search}%")
                  ->orWhere('phone_number', 'LIKE', "%{$request->search}%");
        }

        return response()->json([
            'success' => true,
            'data' => $query->orderBy('id', 'desc')->paginate(10)
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer|exists:users,id|unique:owners,user_id', 
            'name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
        ]);

        $owner = Owner::create($request->only(['user_id', 'name', 'phone_number']));
        // $user = User::find($request->user_id);
        // $user->update(['role' => 'owner']);

        return response()->json([
            'success' => true,
            'message' => 'Owner berhasil ditambahkan',
            'data' => $owner
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
        ]);

        $owner = Owner::findOrFail($id);
        $owner->update($request->only(['name', 'phone_number']));

        return response()->json([
            'success' => true,
            'message' => 'Data owner berhasil diperbarui',
            'data' => $owner
        ]);
    }

    public function destroy($id)
    {
        $owner = Owner::findOrFail($id);
        $owner->delete();

        return response()->json([
            'success' => true,
            'message' => 'Owner berhasil dihapus'
        ]);
    }
}