<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MasterRw extends Model
{
    protected $table = 'ms_rw';

    // Jika Anda tidak ingin menggunakan timestamps
    public $timestamps = true;

    // Mendapatkan semua pengguna menggunakan query raw
    public static function getAllRws()
    {
        return DB::select("SELECT * FROM ms_rw");
    }

    public static function getDataKecamatan($kec_id,$search){
        if($kec_id == ""){
            return DB::select("SELECT * FROM ms_kecamatan WHERE nama LIKE :search LIMIT 15", ['search' => '%' . $search . '%']);    
        }
        else{
            return DB::select("SELECT * FROM ms_kecamatan WHERE id = $kec_id");    
        }
    }
 
    public static function getDataKelurahan($kec_id, $search)
    {
        return DB::select(
            "SELECT * FROM ms_kelurahan WHERE kec_id = :kec_id AND nama LIKE :search LIMIT 15",
            ['kec_id' => $kec_id, 'search' => '%' . $search . '%']
        );
    }

    // Menambahkan pengguna menggunakan query raw
    public static function createRw($kode, $nama, $singkatan, $kel_id)
    {
        return DB::insert("INSERT INTO ms_rw (kode, nama, singkatan, kel_id, created_at, updated_at) VALUES (?, ?, ?, ?, now(), now())", [$kode, $nama, $singkatan, $kel_id]);
    }

    // Mengupdate pengguna menggunakan query raw
    public static function updateRw($id, $kode, $nama, $singkatan, $kel_id)
    {
        return DB::update("UPDATE ms_rw SET kode = ?, nama = ?, singkatan = ?, kel_id = ?, updated_at = now() WHERE id = ?", [$kode, $nama, $singkatan, $kel_id, $id]);
    }

    // Menghapus pengguna menggunakan query raw
    public static function deleteUser($id)
    {
        return DB::delete("DELETE FROM ms_rw WHERE id = ?", [$id]);
    }
}
    