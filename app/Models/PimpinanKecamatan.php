<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PimpinanKecamatan extends Model
{
    protected $table = 'pimpinan_kecamatan';
    protected $fillable = [
        'kec_id',
        'nip',
        'nama',
        'jabatan',
        'status'
    ];
} 