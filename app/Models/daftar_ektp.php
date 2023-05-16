<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Daftar_ektp extends Model
{
    use HasFactory;
    protected $table = 'daftar_ektp';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama', 'nik','telepon', 'tingkatan', 'tahun_daftar'
    ];
}
