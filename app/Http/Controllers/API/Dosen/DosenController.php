<?php

namespace App\Http\Controllers\API\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\User;

class DosenController extends Controller
{
    public function index()
    {
        // Ambil semua kelas beserta matkul dan dosen (user)
        $kelas = Kelas::with(['matkul', 'user'])->get();

        return response()->json([
            'kelas' => $kelas
        ]);
    }

    public function mahasiswa()
    {
        // Ambil semua user dengan role mahasiswa
        $mahasiswa = User::where('role', 'Mahasiswa')->get();

        return response()->json([
            'mahasiswa' => $mahasiswa
        ]);
    }
}
