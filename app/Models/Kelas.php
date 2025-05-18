<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $guarded =[];

    public function matkul()
    {
        return $this->belongsTo(Matkul::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}
