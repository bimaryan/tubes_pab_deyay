<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $guarded =[];

    public function user()
    {
        $this->belongsTo(User::class, 'users_id');
    }

    public function matkul()
    {
        $this->belongsTo(Matkul::class);
    }
}
