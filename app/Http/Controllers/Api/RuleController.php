<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Rule;
use Illuminate\Http\Request;

class RuleController extends Controller
{
    public function index(Request $request)
    {
        $query = Rule::query();

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
            'name' => 'required|string|unique:rules,name|max:255',
            'icon_name' => 'nullable|string|max:50'
        ]);

        $rule = Rule::create([
            'name' => $request->name,
            'icon_name' => $request->icon_name
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Aturan berhasil ditambahkan',
            'data' => $rule
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:rules,name,' . $id,
            'icon_name' => 'nullable|string|max:50'
        ]);

        $rule = Rule::findOrFail($id);
        $rule->update([
            'name' => $request->name,
            'icon_name' => $request->icon_name
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Aturan berhasil diperbarui',
            'data' => $rule
        ]);
    }

    public function destroy($id)
    {
        $rule = Rule::findOrFail($id);
        $rule->delete();

        return response()->json([
            'success' => true,
            'message' => 'Aturan berhasil dihapus'
        ]);
    }

    public function getKosList(Request $request)
    {
        $query = \App\Models\KosPlace::withCount('rules'); 

        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'LIKE', "%{$request->search}%");
        }

        return response()->json([
            'success' => true,
            'data' => $query->orderBy('id', 'asc')->paginate(10)
        ]);
    }

    public function getKosRulesDetail($id)
    {
        $kos = \App\Models\KosPlace::with('rules')->findOrFail($id);
        $allRules = Rule::orderBy('name', 'asc')->get();

        return response()->json([
            'success' => true,
            'data' => [
                'kos' => [
                    'id' => $kos->id,
                    'name' => $kos->name,
                ],
                'attached_rule_ids' => $kos->rules->pluck('id'), 
                'all_rules' => $allRules
            ]
        ]);
    }

    public function syncKosRules(Request $request, $id)
    {
        $request->validate([
            'rule_ids' => 'array',
            'rule_ids.*' => 'exists:rules,id' 
        ]);

        $kos = \App\Models\KosPlace::findOrFail($id);
        
        $kos->rules()->sync($request->rule_ids ?? []);

        return response()->json([
            'success' => true,
            'message' => 'Aturan kos berhasil diperbarui'
        ]);
    }
}