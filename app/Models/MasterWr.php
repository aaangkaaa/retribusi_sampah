<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MasterWr extends Model
{
    protected $table = 'tr_wajib_retribusi';

    // Jika Anda tidak ingin menggunakan timestamps
    public $timestamps = true;

    // Mendapatkan semua pengguna menggunakan query raw
    public static function getAllRws()
    {
        return DB::select("SELECT * FROM tr_wajib_retribusi");
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

    public static function getDataRt($rw_id, $search)
    {
        return DB::select(
            "SELECT * FROM ms_rt WHERE rw_id = :rw_id AND nama LIKE :search LIMIT 15",
            ['rw_id' => $rw_id, 'search' => '%' . $search . '%']
        );
    }

    public static function getDataTarif($search)
    {
        return DB::select(
            "SELECT * FROM ms_tarif WHERE nama LIKE :search LIMIT 15",
            ['search' => '%' . $search . '%']
        );
    }

    public static function getMaxKode($rt_id){
        return DB::select(
            "SELECT LPAD(IFNULL(MAX(CAST(RIGHT(npwr,3) AS SIGNED))+1,1),3,0) AS kode FROM tr_wajib_retribusi WHERE rt_id = :rt_id",
            ['rt_id' => $rt_id]
        );
    }

    // Menambahkan pengguna menggunakan query raw
    public static function createWr($npwr,$nama,$alamat,$rt_id,$kontak,$tarif_id,$status,$nop = null, $no_kk = null, $kwh = null)
    {
        return DB::insert("INSERT INTO tr_wajib_retribusi (npwr, nama, alamat, rt_id, kontak, tarif_id, status, nop, no_kk, kwh, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, now(), now())", [$npwr,$nama,$alamat,$rt_id,$kontak,$tarif_id,$status,$nop,$no_kk,$kwh]);
    }

    // Mengupdate pengguna menggunakan query raw
    public static function updateWr($id, $nama, $alamat, $kontak , $tarif_id , $status, $nop = null, $no_kk = null, $kwh = null)
    {
        return DB::update("UPDATE tr_wajib_retribusi SET nama = ?,alamat = ? ,kontak = ? ,tarif_id = ? ,status = ?, nop = ?, no_kk = ?, kwh = ?, updated_at = now() WHERE id = ?", [$nama, $alamat, $kontak , $tarif_id , $status, $nop, $no_kk, $kwh, $id]);
    }

    // Menghapus pengguna menggunakan query raw
    public static function deleteUser($id)
    {
        return DB::delete("DELETE FROM tr_wajib_retribusi WHERE id = ?", [$id]);
    }
}
    