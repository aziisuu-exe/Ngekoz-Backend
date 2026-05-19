<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bank; 
use Illuminate\Http\Request;

class BankController extends Controller
{
    public function index(Request $request)
    {
        $query = Bank::query();

        if ($request->has('search') && $request->search != '') {
            $query->where('bank_name', 'LIKE', "%{$request->search}%")
                  ->orWhere('bank_code', 'LIKE', "%{$request->search}%")
                  ->orWhere('num_code', 'LIKE', "%{$request->search}%");
        }

        return response()->json([
            'success' => true,
            'data' => $query->orderBy('bank_name', 'asc')->paginate(10)
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'bank_name' => 'required|string|max:255',
            'bank_code' => 'required|string|max:50|unique:banks,bank_code',
            'num_code'  => 'required|string|max:10' 
        ]);

        $bank = Bank::create($request->only(['bank_name', 'bank_code', 'num_code']));

        return response()->json([
            'success' => true,
            'message' => 'Bank berhasil ditambahkan',
            'data' => $bank
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'bank_name' => 'required|string|max:255',
            'bank_code' => 'required|string|max:50|unique:banks,bank_code,' . $id,
            'num_code'  => 'required|string|max:10'
        ]);

        $bank = Bank::findOrFail($id);
        $bank->update($request->only(['bank_name', 'bank_code', 'num_code']));

        return response()->json([
            'success' => true,
            'message' => 'Bank berhasil diperbarui',
            'data' => $bank
        ]);
    }

    public function destroy($id)
    {
        $bank = Bank::findOrFail($id);
        $bank->delete();

        return response()->json([
            'success' => true,
            'message' => 'Bank berhasil dihapus'
        ]);
    }
}