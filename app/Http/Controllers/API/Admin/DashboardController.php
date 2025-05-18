<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalMhs = User::where('role', 'Mahasiswa')->count();
        $totalDsn = User::where('role', 'Dosen')->count();

        return response()->json([
            'total_mahasiswa' => $totalMhs,
            'total_dosen' => $totalDsn,
            'total_user' => $totalMhs + $totalDsn
        ]);
    } 
}