<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MasterKecamatan extends Model
{
    protected $table = 'ms_kecamatan';

    // Jika Anda tidak ingin menggunakan timestamps
    public $timestamps = true;

    // Mendapatkan semua pengguna menggunakan query raw
    public static function getAllKecamatans()
    {
        return DB::select("SELECT * FROM ms_kecamatan");
    }
    public static function find($id)
    {
        return DB::select("SELECT * FROM ms_kecamatan WHERE id = ?",[$id]);
    }
    public static function getKecamatanById($id)
    {
        return DB::select("SELECT nama FROM ms_kecamatan WHERE id = ?",[$id]);
    }

    // Menambahkan pengguna menggunakan query raw
    public static function createKecamatan($kode, $nama)
    {
        return DB::insert("INSERT INTO ms_kecamatan (kode, nama, created_at, updated_at) VALUES (?, ?, now(), now())", [$kode, $nama]);
    }

    // Mengupdate pengguna menggunakan query raw
    public static function updateKecamatan($id, $kode, $nama)
    {
        return DB::update("UPDATE ms_kecamatan SET kode = ?, nama = ?, updated_at = now() WHERE id = ?", [$kode, $nama, $id]);
    }

    // Menghapus pengguna menggunakan query raw
    public static function deleteUser($id)
    {
        return DB::delete("DELETE FROM ms_kecamatan WHERE id = ?", [$id]);
    }
}
