<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\MasterKecamatan;

class MasterKelurahan extends Model
{
    protected $table = 'ms_kelurahan';

    // Jika Anda tidak ingin menggunakan timestamps
    public $timestamps = true;

    // Mendapatkan semua pengguna menggunakan query raw
    public static function getAllKelurahans()
    {
        return DB::select("SELECT * FROM ms_kelurahan");
    }

    public function getKecamatans(){
        $kecamatan = new MasterKecamatan();
        $id_kecamatan = Session::get('kec_id');
        if($id_kecamatan == ""){
            return $kecamatan->getAllKecamatans();
        }
        else{
            return $kecamatan->getCategoryName($id_kecamatan);
        }
    }
    // Menambahkan pengguna menggunakan query raw
    public static function createKelurahan($kode, $nama, $singkatan = null)
    {
        return DB::insert("INSERT INTO ms_kelurahan (kode, nama, singkatan, created_at, updated_at) VALUES (?, ?, ?, now(), now())", [$kode, $nama, $singkatan]);
    }

    // Mengupdate pengguna menggunakan query raw
    public static function updateKelurahan($id, $kode, $nama, $singkatan = null)
    {
        return DB::update("UPDATE ms_kelurahan SET kode = ?, nama = ?, singkatan = ?, updated_at = now() WHERE id = ?", [$kode, $nama, $singkatan, $id]);
    }

    // Menghapus pengguna menggunakan query raw
    public static function deleteUser($id)
    {
        return DB::delete("DELETE FROM ms_kelurahan WHERE id = ?", [$id]);
    }
}
