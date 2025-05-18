<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DosenController extends Controller
{
    // Tampilkan semua dosen
    public function index()
    {
        $dosen = User::where('role', 'Dosen')->get();
        return response()->json($dosen);
    }

    // Tambah dosen
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'nim'      => 'required|string|max:100|unique:users,nim',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        $dosen = User::create([
            'name'     => $request->name,
            'nim'      => $request->nim,
            'email'    => $request->email,
            'role'     => 'Dosen',
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'message' => 'Dosen berhasil ditambahkan',
            'data'    => $dosen,
        ], 201);
    }

    // Tampilkan dosen berdasarkan ID
    public function show($id)
    {
        $dosen = User::where('role', 'Dosen')->findOrFail($id);
        return response()->json($dosen);
    }

    // Update dosen
    public function update(Request $request, $id)
    {
        $dosen = User::where('role', 'Dosen')->findOrFail($id);

        $request->validate([
            'name'     => 'nullable|string|max:255',
            'nim'      => 'nullable|string|max:100|unique:users,nim,' . $dosen->id,
            'email'    => 'nullable|email|unique:users,email,' . $dosen->id,
            'password' => 'nullable|string|min:6',
        ]);

        $dosen->update([
            'name'     => $request->name ?? $dosen->name,
            'nim'      => $request->nim ?? $dosen->nim,
            'email'    => $request->email ?? $dosen->email,
            'password' => $request->filled('password') ? Hash::make($request->password) : $dosen->password,
            'role'     => 'Dosen', // pastikan tidak berubah
        ]);

        return response()->json(['message' => 'Dosen berhasil diperbarui']);
    }

    // Hapus dosen
    public function destroy($id)
    {
        $dosen = User::where('role', 'Dosen')->findOrFail($id);
        $dosen->delete();

        return response()->json(['message' => 'Dosen berhasil dihapus']);
    }
}
