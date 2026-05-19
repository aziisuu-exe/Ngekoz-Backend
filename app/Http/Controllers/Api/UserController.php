<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Cloudinary\Configuration\Configuration;
use Cloudinary\Api\Upload\UploadApi;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();
        $query->where('role', '!=', 'admin');

        if ($request->has('search') && $request->search != '') {
            $searchTerm = $request->search;
            $query->where('full_name', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('email', 'LIKE', "%{$searchTerm}%");
                
        }

        $users = $query->orderBy('id', 'asc')->paginate(10);
        
        return response()->json([
            'success' => true,
            'message' => 'Daftar data users NGEKOZ',
            'data' => $users
        ]);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user->update([
            'full_name' => $request->full_name ?? $user->full_name,
            'phone_number' => $request->phone_number ?? $user->phone_number,
            'bio' => $request->bio ?? $user->bio,
            'role' => $request->role ?? $user->role,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data user berhasil diperbarui',
            'data' => $user
        ]);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'User berhasil dihapus'
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'username'  => 'required|string|unique:users,username|max:50', // Tambahkan ini
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required|min:6',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();
        $data['password'] = bcrypt($request->password);

        if ($request->hasFile('profile_picture')) {
            Configuration::instance(env('CLOUDINARY_URL'));
            $upload = new UploadApi();
            $result = $upload->upload($request->file('profile_picture')->getRealPath(), [
                'folder' => 'ngekoz_profiles'
            ]);
            $data['profile_picture'] = $result['secure_url'];
        }

        $user = User::create($data);

        return response()->json([
            'success' => true,
            'message' => 'User berhasil ditambahkan',
            'data' => $user
        ]);
    }
}