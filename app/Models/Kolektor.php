<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kolektor extends Model
{
    use HasFactory;

    protected $table = 'kolektor';

    protected $fillable = [
        'kel_id',
        'nama',
        'nik',
        'status',
    ];

    // Relasi ke ms_kelurahan
    public function kelurahan()
    {
        return $this->belongsTo(MasterKelurahan::class, 'kel_id');
    }

    // Relasi ke tr_penetapan
    public function penetapans()
    {
        return $this->hasMany(PenetapanWr::class, 'kolektor_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($kolektor) {
            if ($kolektor->penetapans()->count() > 0) {
                throw new \Exception("Tidak Dapat Menghapus Kolektor Karena Telah Digunakan Dalam Data Penetapan.");
            }
        });
    }
}
