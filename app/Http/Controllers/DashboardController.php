<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Exception;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        try {
            // Debug: Log all session data
            Log::info('Session Data:', session()->all());
            
            $userData = Session::get('user');
            
            if (empty($userData)) {
                throw new Exception('User session not found. Please log in again.');
            }
            
            Log::info('User Data from Session:', is_array($userData) ? $userData : ['user' => 'invalid format']);
            
            $kecId = is_array($userData) ? ($userData['kec_id'] ?? null) : null;
            
            if (empty($kecId)) {
                throw new Exception('Kecamatan ID not found in session. Please ensure your account has a valid Kecamatan assigned.');
            }
            
            $data = [
                'npwr' => DB::table('tr_wajib_retribusi')
                    ->join('ms_rt', 'tr_wajib_retribusi.rt_id', '=', 'ms_rt.id')
                    ->join('ms_rw', 'ms_rt.rw_id', '=', 'ms_rw.id')
                    ->join('ms_kelurahan', 'ms_rw.kel_id', '=', 'ms_kelurahan.id')
                    ->join('ms_kecamatan', 'ms_kelurahan.kec_id', '=', 'ms_kecamatan.id')
                    ->where('ms_kecamatan.id', $kecId)
                    ->count(),
                    
                'tagihan' => DB::table('tr_penetapan')
                    ->join('tr_wajib_retribusi', 'tr_penetapan.wr_id', '=', 'tr_wajib_retribusi.id')
                    ->join('ms_rt', 'tr_wajib_retribusi.rt_id', '=', 'ms_rt.id')  
                    ->join('ms_rw', 'ms_rt.rw_id', '=', 'ms_rw.id')
                    ->join('ms_kelurahan', 'ms_rw.kel_id', '=', 'ms_kelurahan.id')
                    ->join('ms_kecamatan', 'ms_kelurahan.kec_id', '=', 'ms_kecamatan.id')
                    ->join('ms_tarif', 'tr_penetapan.tarif_id', '=', 'ms_tarif.id')
                    ->where('ms_kecamatan.id', $kecId)
                    ->sum('nilai'),
                    
                'pembayaran' => DB::table('tr_pembayaran')
                    ->join('tr_wajib_retribusi', 'tr_pembayaran.wr_id', '=', 'tr_wajib_retribusi.id')
                    ->join('ms_rt', 'tr_wajib_retribusi.rt_id', '=', 'ms_rt.id')  
                    ->join('ms_rw', 'ms_rt.rw_id', '=', 'ms_rw.id')
                    ->join('ms_kelurahan', 'ms_rw.kel_id', '=', 'ms_kelurahan.id')
                    ->join('ms_kecamatan', 'ms_kelurahan.kec_id', '=', 'ms_kecamatan.id')
                    ->where('ms_kecamatan.id', $kecId)
                    ->sum('jumlah')
            ];
            // print_r($data);
            return view('dashboard', $data);
            
        } catch (\Exception $e) {
            Log::error('Dashboard error: ' . $e->getMessage());
            // print_r($e->getMessage());
            return view('dashboard', [
                'npwr' => 0,
                'tagihan' => 0,
                'pembayaran' => 0
            ]);
        }
    }
}
