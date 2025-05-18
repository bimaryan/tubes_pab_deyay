<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::whereIn('role', ['Dosen', 'Mahasiswa'])->get();

        return response()->json($users);
    }
}
