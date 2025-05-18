<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MahasiswaController extends Controller
{
    // Tambah Mahasiswa
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'nim' => 'required|string|unique:users,nim',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'nim' => $request->nim,
            'email' => $request->email,
            'role' => 'Mahasiswa',
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'message' => 'Data Mahasiswa telah ditambahkan',
        ]);
    }

    // Tampilkan semua mahasiswa
    public function index()
    {
        $mahasiswa = User::where('role', 'Mahasiswa')->get();

        return response()->json($mahasiswa);
    }

    // Tampilkan mahasiswa berdasarkan ID
    public function show($id)
    {
        $mahasiswa = User::where('role', 'Mahasiswa')->findOrFail($id);

        return response()->json($mahasiswa);
    }

    // Update data mahasiswa
    public function update(Request $request, $id)
    {
        $mahasiswa = User::where('role', 'Mahasiswa')->findOrFail($id);

        $request->validate([
            'name' => 'sometimes|required|string',
            'nim' => 'sometimes|required|string|unique:users,nim,' . $mahasiswa->id,
            'email' => 'sometimes|required|email|unique:users,email,' . $mahasiswa->id,
            'password' => 'nullable|string|min:6',
        ]);

        $mahasiswa->update([
            'name' => $request->name ?? $mahasiswa->name,
            'nim' => $request->nim ?? $mahasiswa->nim,
            'email' => $request->email ?? $mahasiswa->email,
            'password' => $request->password ? Hash::make($request->password) : $mahasiswa->password,
        ]);

        return response()->json([
            'message' => 'Data Mahasiswa berhasil diperbarui',
        ]);
    }

    // Hapus mahasiswa
    public function destroy($id)
    {
        $mahasiswa = User::where('role', 'Mahasiswa')->findOrFail($id);
        $mahasiswa->delete();

        return response()->json([
            'message' => 'Data Mahasiswa berhasil dihapus',
        ]);
    }
}
