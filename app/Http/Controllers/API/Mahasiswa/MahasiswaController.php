<?php

namespace App\Http\Controllers\API\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Matkul;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index(Request $request)
    {
        // (1) Semua kelas beserta relasi matkul & dosen
        $kelas = Kelas::with(['matkul', 'user'])->get();

        // (2) Semua matkul
        $matkul = Matkul::all();

        return response()->json([
            'kelas'  => $kelas,
            'matkul' => $matkul,
        ]);
    }
}
