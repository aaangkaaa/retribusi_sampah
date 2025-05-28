<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\PenetapanWr;
use App\Models\Pembayaran;
use App\Models\MasterWr;

class LandingController extends Controller
{
    /**
     * Display the landing page
     */
    public function index()
    {
        return view('landing');
    }

    /**
     * Search for NPWR and return data
     */
    public function searchNpwr(Request $request)
    {
        try {
            // Validasi input untuk mencegah SQL injection
            $validated = $request->validate([
                'npwr' => 'required|string|max:50|regex:/^[A-Za-z0-9\.\-]+$/'
            ]);
            
            $npwr = $validated['npwr'];
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Format NPWR tidak valid. Gunakan format yang benar, contoh: NPWR-12345678'
            ], 422);
        }
        
        // Find the Wajib Retribusi data
        $wajibRetribusi = DB::table('tr_wajib_retribusi')
        ->join('ms_rt', 'tr_wajib_retribusi.rt_id', '=', 'ms_rt.id')
        ->join('ms_rw', 'ms_rt.rw_id', '=', 'ms_rw.id')
        ->join('ms_kelurahan', 'ms_rw.kel_id', '=', 'ms_kelurahan.id')
        ->join('ms_kecamatan', 'ms_kelurahan.kec_id', '=', 'ms_kecamatan.id')
        ->select('tr_wajib_retribusi.*', 'ms_rt.nama as rt', 'ms_rw.nama as rw', 'ms_kelurahan.nama as kelurahan', 'ms_kecamatan.nama as kecamatan')
        ->where('npwr', $npwr)->first();
        
        if (!$wajibRetribusi) {
            return response()->json([
                'success' => false,
                'message' => 'NPWR tidak ditemukan'
            ]);
        }
        
        // Get the billing history
        $penetapan = DB::table('tr_penetapan')
            ->select('tr_penetapan.*', 'ms_tarif.nilai as tarif')
            ->join('ms_tarif', 'tr_penetapan.tarif_id', '=', 'ms_tarif.id')
            ->where('wr_id', $wajibRetribusi->id)
            ->orderBy('tahun', 'desc')
            ->orderBy('periode', 'desc')
            ->take(12) // Last 12 months
            ->get();
            
        // Format the billing data
        $bills = [];
        foreach ($penetapan as $item) {
            // Check if bill is paid
            $pembayaran = DB::table('trd_pembayaran')
            ->select(DB::raw('ifnull(SUM(total_pembayaran), 0) as jumlah'))
            ->where('penetapan_id', $item->id)
            ->first();
            
            $jumlahBayar = $pembayaran ? $pembayaran->jumlah : 0;
            $status = $jumlahBayar >= $item->tarif ? 'Lunas' : 'Belum Lunas';
            
            // Get month name
            $bulanNames = [
                1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
                5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
                9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
            ];
            
            $periode = isset($bulanNames[$item->periode]) ? $bulanNames[$item->periode] : $item->periode;
            
            $bills[] = [
                'period' => $periode . ' ' . $item->tahun,
                'amount' => 'Rp ' . number_format($item->tarif, 2, '.', ','),
                'paid' => 'Rp ' . number_format($jumlahBayar, 2, '.', ','),
                'status' => $status
            ];
        }
        
        return response()->json([
            'success' => true,
            'data' => [
                'name' => $wajibRetribusi->nama,
                'address' => $wajibRetribusi->alamat.', '.$wajibRetribusi->rt.', '.$wajibRetribusi->rw.', '.$wajibRetribusi->kelurahan.', '.$wajibRetribusi->kecamatan,
                'npwr' => $wajibRetribusi->npwr,
                'bills' => $bills
            ]
        ]);
    }
}
