<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\PenetapanWr;

class PimpinanKecamatan extends Model
{
    protected $table = 'pimpinan_kecamatan';
    protected $fillable = [
        'kec_id',
        'nip',
        'nama',
        'jabatan',
        'status',
        'status_jabatan'
    ];

    // Relasi ke tr_penetapan
    public function penetapans()
    {
        return $this->hasMany(PenetapanWr::class, 'pimpinan_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($pimpinan) {
            if ($pimpinan->penetapans()->count() > 0) {
                throw new \Exception("Tidak Dapat Menghapus PimpinanKecamatan Karena Telah Digunakan Dalam  Data Penetapan.");
            }
        });
    }
}
