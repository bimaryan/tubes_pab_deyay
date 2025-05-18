<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Matkul;

class MatkulController extends Controller
{
    public function index()
    {
        $data = Matkul::all();
        return response()->json($data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_matkul' => 'required|string|max:255',
        ]);

        $matkul = Matkul::create([
            'nama_matkul' => $request->nama_matkul,
        ]);

        return response()->json([
            'message' => 'Mata kuliah berhasil ditambahkan',
            'data' => $matkul
        ], 201);
    }

    public function show($id)
    {
        $matkul = Matkul::findOrFail($id);
        return response()->json($matkul);
    }

    public function update(Request $request, $id)
    {
        $matkul = Matkul::findOrFail($id);

        $request->validate([
            'nama_matkul' => 'required|string|max:255',
        ]);

        $matkul->update([
            'nama_matkul' => $request->nama_matkul,
        ]);

        return response()->json([
            'message' => 'Mata kuliah berhasil diperbarui',
            'data' => $matkul
        ]);
    }

    public function destroy($id)
    {
        $matkul = Matkul::findOrFail($id);
        $matkul->delete();

        return response()->json([
            'message' => 'Mata kuliah berhasil dihapus'
        ]);
    }
}
