<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kelas;

class KelasController extends Controller
{
    public function index()
    {
        $data = Kelas::with(['matkul', 'user'])->get();
        return response()->json($data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:255',
            'matkul_id' => 'required|exists:matkuls,id',
            'users_id' => 'required|exists:users,id',
        ]);

        $kelas = Kelas::create($request->all());

        return response()->json([
            'message' => 'Kelas berhasil ditambahkan',
            'data' => $kelas
        ], 201);
    }

    public function show($id)
    {
        $kelas = Kelas::with(['matkul', 'user'])->findOrFail($id);
        return response()->json($kelas);
    }

    public function update(Request $request, $id)
    {
        $kelas = Kelas::findOrFail($id);

        $request->validate([
            'nama_kelas' => 'sometimes|required|string|max:255',
            'matkul_id' => 'sometimes|required|exists:matkuls,id',
            'users_id' => 'sometimes|required|exists:users,id',
        ]);

        $kelas->update($request->all());

        return response()->json([
            'message' => 'Kelas berhasil diperbarui',
            'data' => $kelas
        ]);
    }

    public function destroy($id)
    {
        $kelas = Kelas::findOrFail($id);
        $kelas->delete();

        return response()->json([
            'message' => 'Kelas berhasil dihapus'
        ]);
    }
}
