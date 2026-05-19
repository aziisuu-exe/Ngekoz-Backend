<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ManageUserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->latest()->paginate(10);

        return response()->json([
            'status' => 'success',
            'message' => 'Daftar semua pengguna berhasil diambil',
            'data' => $users
        ], 200);
    }

    public function updateRole(Request $request, $id)
    {
        $request->validate([
            'role' => 'required|in:admin,owner,user'
        ]);

        $user = User::findOrFail($id);
        
        $user->syncRoles([$request->role]);

        return response()->json([
            'status' => 'success',
            'message' => 'Role pengguna berhasil diubah menjadi ' . $request->role,
            'data' => $user->load('roles')
        ], 200);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Pengguna berhasil dihapus dari sistem.'
        ], 200);
    }
}