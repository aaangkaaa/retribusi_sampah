<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PenetapanWr extends Model
{
    protected $table = 'tr_penetapan';

    // Jika Anda tidak ingin menggunakan timestamps
    public $timestamps = true;

    // Mendapatkan semua pengguna menggunakan query raw
    public static function getAllRws()
    {
        return DB::select("SELECT * FROM tr_penetapan");
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
            "SELECT LPAD(IFNULL(MAX(CAST(RIGHT(npwr,3) AS SIGNED))+1,1),3,0) AS kode FROM tr_penetapan WHERE rt_id = :rt_id",
            ['rt_id' => $rt_id]
        );
    }

    // Menambahkan pengguna menggunakan query raw
    public static function createPenetapan($kec_id,$tahun,$bulan,$tgl_penetapan,$tgl_tempo)
    {
        DB::statement("
            SET @no_seri=0,@kel_id=0;
        ");
        return DB::statement("
            INSERT INTO tr_penetapan (wr_id,tarif_id,periode,tahun,tgl_penetapan,tgl_tempo,jumlah,status,created_at,updated_at,no_seri)
            SELECT wr_id,tarif_id,periode,tahun,tgl_penetapan,tgl_tempo,jumlah,status,created_at,updated_at,no_seri
            FROM(
                SELECT a.id AS wr_id,
                    a.tarif_id,
                    '$bulan' AS periode,
                    '$tahun' AS tahun,
                    '$tgl_penetapan' AS tgl_penetapan,
                    '$tgl_tempo' AS tgl_tempo,
                    0 AS jumlah,
                    '1' AS STATUS,
                    NOW() AS created_at,
                    NOW() AS updated_at,
                    -- Mengambil nomor seri + 1 dari subquery yang menghitung MAX(no_seri) per kelurahan
                    IF(@kel_id<>d.id,CONCAT(d.singkatan,@no_seri:=COALESCE(b.max_seri + 1, 1)),CONCAT(d.singkatan,@no_seri:=@no_seri+1)) AS no_seri,
                    @kel_id:=d.id
                FROM tr_wajib_retribusi a
                LEFT JOIN ms_rt b ON a.rt_id = b.id
                LEFT JOIN ms_rw c ON b.rw_id = c.id
                LEFT JOIN ms_kelurahan d ON c.kel_id = d.id
                LEFT JOIN ms_kecamatan e ON d.kec_id = e.id
                LEFT JOIN (
                    SELECT d.kel_id, MAX(CAST(a.no_seri AS UNSIGNED)) AS max_seri
                    FROM tr_penetapan a
                    LEFT JOIN tr_wajib_retribusi b ON a.wr_id = b.id
                    LEFT JOIN ms_rt c ON b.rt_id = c.id
                    LEFT JOIN ms_rw d ON c.rw_id = d.id
                    LEFT JOIN ms_kelurahan e ON d.kel_id=e.id
                    WHERE a.tahun = '$tahun'
                    GROUP BY d.kel_id 
                ) b ON d.id = b.kel_id
                WHERE e.id = $kec_id
                ORDER BY npwr
            )a;

        ");
    }

    // Mengupdate pengguna menggunakan query raw
    public static function updateRw($id, $nama, $alamat, $kontak , $tarif_id , $status)
    {
        return DB::update("UPDATE tr_penetapan SET nama = ?,alamat = ? ,kontak = ? ,tarif_id = ? ,status = ?, updated_at = now() WHERE id = ?", [$id, $nama, $alamat, $kontak , $tarif_id , $status]);
    }

    // Menghapus pengguna menggunakan query raw
    public static function deleteUser($id)
    {
        return DB::delete("DELETE FROM tr_penetapan WHERE id = ?", [$id]);
    }
    public static function getCetakSkrd($bulan,$tahun)
    {
        session_write_close();
        return DB::select("
            SELECT x.no_seri,e.nama AS nm_kecamatan,x.tgl_penetapan, x.periode AS bulan, x.tahun, a.nama, a.alamat, a.npwr, x.tgl_tempo, f.nilai AS jumlah
            FROM tr_penetapan X
            LEFT JOIN tr_wajib_retribusi a ON x.wr_id = a.id
            LEFT JOIN ms_rt b ON a.rt_id = b.id
            LEFT JOIN ms_rw c ON b.rw_id = c.id
            LEFT JOIN ms_kelurahan d ON c.kel_id = d.id
            LEFT JOIN ms_kecamatan e ON d.kec_id = e.id
            LEFT JOIN ms_tarif f ON x.tarif_id = f.id
            WHERE x.periode = ? AND x.tahun = ? 
            ORDER BY npwr
        ", [$bulan, $tahun]);
    }
}
    