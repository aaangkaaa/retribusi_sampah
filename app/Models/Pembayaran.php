<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pembayaran extends Model
{
    protected $table = 'tr_pembayaran';
    protected $fillable = [
        'wr_id',
        'tgl_pembayaran',
        'jumlah',
        'keterangan',
    ];
    public static function getCetakStbp($id)
    {
        return Pembayaran::select(
            'tr_pembayaran.id',
            'tr_pembayaran.wr_id',
            'a.npwr',
            'a.nama',
            'a.alamat',
            'tr_pembayaran.tgl_pembayaran',
            'f.total_pembayaran AS jumlah',
            'tr_pembayaran.keterangan',
            'e.nama AS kecamatan',
            'f.bulan'
        )
        ->leftJoin('tr_wajib_retribusi AS a', 'tr_pembayaran.wr_id', '=', 'a.id')
        ->leftJoin('ms_rt AS b', 'a.rt_id', '=', 'b.id')
        ->leftJoin('ms_rw AS c', 'b.rw_id', '=', 'c.id')
        ->leftJoin('ms_kelurahan AS d', 'c.kel_id', '=', 'd.id')
        ->leftJoin('ms_kecamatan AS e', 'd.kec_id', '=', 'e.id')
        ->leftJoin(DB::raw("(
            SELECT pembayaran_id, 
                   GROUP_CONCAT(b.periode) AS bulan,
                   SUM(a.total_pembayaran) AS total_pembayaran 
            FROM trd_pembayaran a 
            LEFT JOIN tr_penetapan b ON a.penetapan_id=b.id 
            GROUP BY a.pembayaran_id
        ) f"), function($join) {
            $join->on('tr_pembayaran.id', '=', 'f.pembayaran_id');
        })
        ->where('tr_pembayaran.id', $id)
        ->first();
    }
} 