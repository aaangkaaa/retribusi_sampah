<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MasterRt extends Model
{
    protected $table = 'ms_rt';

    // Jika Anda tidak ingin menggunakan timestamps
    public $timestamps = true;

    // Mendapatkan semua pengguna menggunakan query raw
    public static function getAllRws()
    {
        return DB::select("SELECT * FROM ms_rt");
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

    public static function getDataRw($kel_id, $search)
    {
        return DB::select(
            "SELECT * FROM ms_rw WHERE kel_id = :kel_id AND nama LIKE :search LIMIT 15",
            ['kel_id' => $kel_id, 'search' => '%' . $search . '%']
        );
    }
    // Menambahkan pengguna menggunakan query raw
    public static function createRt($kode, $nama, $rw_id)
    {
        return DB::insert("INSERT INTO ms_rt (rw_id, kode, nama, created_at, updated_at) VALUES (?, ?, ?, now(), now())", [$rw_id, $kode, $nama]);
    }

    // Mengupdate pengguna menggunakan query raw
    public static function updateRt($id, $kode, $nama, $rw_id)
    {
        return DB::update("UPDATE ms_rt SET kode = ?, nama = ?, rw_id = ?, updated_at = now() WHERE id = ?", [$kode, $nama, $rw_id, $id]);
    }

    // Menghapus pengguna menggunakan query raw
    public static function deleteUser($id)
    {
        return DB::delete("DELETE FROM ms_rt WHERE id = ?", [$id]);
    }
}
