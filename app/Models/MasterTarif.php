<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MasterTarif extends Model
{
    protected $table = 'ms_tarif';

    // Jika Anda tidak ingin menggunakan timestamps
    public $timestamps = true;

    // Mendapatkan semua pengguna menggunakan query raw
    public static function getAllTarifs()
    {
        return DB::select("SELECT * FROM ms_tarif");
    }

    // Menambahkan pengguna menggunakan query raw
    public static function createTarif($nama, $nilai)
    {
        return DB::insert("INSERT INTO ms_tarif (nama, nilai, created_at, updated_at) VALUES (?, ?, now(), now())", [$nama, $nilai]);
    }

    // Mengupdate pengguna menggunakan query raw
    public static function updateTarif($id, $nama, $nilai)
    {
        return DB::update("UPDATE ms_tarif SET nama = ?, nilai = ?, updated_at = now() WHERE id = ?", [$nama, $nilai, $id]);
    }

    // Menghapus pengguna menggunakan query raw
    public static function deleteUser($id)
    {
        return DB::delete("DELETE FROM ms_tarif WHERE id = ?", [$id]);
    }

    // Relasi ke tr_penetapan
    public function penetapans()
    {
        return $this->hasMany(PenetapanWr::class, 'tarif_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($tarif) {
            if ($tarif->penetapans()->count() > 0) {
                throw new \Exception("Tidak Dapat Menghapus Master Tarif Ini Karena Telah Digunakan Dalam Data Penetapan.");
            }
        });
    }
}
