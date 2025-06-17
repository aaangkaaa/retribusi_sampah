<?php

namespace App\Http\Controllers;

use App\Models\PenetapanWr;
use App\Models\MasterKecamatan;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Session;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Illuminate\Support\Facades\DB;

class PenetapanWrController extends Controller
{
    protected $penetapanWr;

    // Menggunakan dependency injection
    public function __construct(PenetapanWr $penetapanWr)
    {
        $this->penetapanWr = $penetapanWr;
    }
    public function index(){
        $userData = Session::get('user');
        if(is_array($userData)){
            $kec_id = $userData['kec_id'];
        }
        else{
            $kec_id = '';
        }
        $data['kec'] = MasterKecamatan::select('nama')->where('id',$kec_id)->first();
        // print_r("kec".$kec_id);
        return view('penetapan-wr',$data);
    }
    public function save(Request $request){
        $userData = Session::get('user');
        if(is_array($userData)){
            $kec_id = $userData['kec_id'];
        }
        else{
            $kec_id = '';
        }

        // Cek kelurahan yang belum ada kolektornya dengan status aktif di kecamatan tersebut
        $missingKelurahan = DB::table('ms_kelurahan')
            ->leftJoin('kolektor', function($join) {
                $join->on('ms_kelurahan.id', '=', 'kolektor.kel_id')
                     ->where('kolektor.status', '=', 1);
            })
            ->where('ms_kelurahan.kec_id', $kec_id)
            ->whereNull('kolektor.id')
            ->pluck('ms_kelurahan.nama')
            ->toArray();

        if (count($missingKelurahan) > 0) {
            $message = "Proses dibatalkan. Kelurahan berikut belum memiliki kolektor aktif: " . implode(", ", $missingKelurahan);
            return response()->json(['kode' => 0, 'message' => $message]);
        }

        $data = $this->penetapanWr->createPenetapan($kec_id,$request->tahun,$request->bulan,$request->tgl_penetapan,$request->tgl_tempo);
        if($data === true){
            $result = array('kode' => 1, "message" => "Data Penetapan berhasil disimpan!");
        }
        else{
            $result = array('kode' => 0, "message" => "Data Penetapan gagal tersimpan!");
        }

        return response()->json($result);

    }
    public function getData(Request $request){
        if ($request->ajax()) {
            $data = PenetapanWr::select('tr_penetapan.*','tr_wajib_retribusi.npwr','tr_wajib_retribusi.nama','tr_wajib_retribusi.alamat','ms_kecamatan.id as kec_id','ms_kecamatan.nama as kecamatan','ms_kelurahan.id as kel_id','ms_kelurahan.nama as kelurahan','ms_rw.id as rw_id','ms_rw.nama as rw','ms_rt.nama as rt')
            ->join('tr_wajib_retribusi', 'tr_wajib_retribusi.id', '=', 'tr_penetapan.wr_id')
            ->join('ms_rt', 'tr_wajib_retribusi.rt_id', '=', 'ms_rt.id')
            ->join('ms_rw', 'ms_rt.rw_id', '=', 'ms_rw.id')
            ->join('ms_kelurahan', 'ms_rw.kel_id', '=', 'ms_kelurahan.id')
            ->join('ms_kecamatan', 'ms_kelurahan.kec_id', '=', 'ms_kecamatan.id')
            ->join('ms_tarif', 'tr_penetapan.tarif_id', '=', 'ms_tarif.id')
            ->where('ms_kecamatan.id',$request->input("kec_id"))
            ->where('tr_penetapan.periode',$request->input("bulan"))
            ->where('tr_penetapan.tahun',$request->input("tahun"));
            $no = 0;
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
       
                    $btn = '<a class="print btn btn-danger btn-sm" title="Cetak SKRD" data-id="'.$row->id.'"><span class="fa fa-print"></span></a> &nbsp; 
                      
                    ';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
    public function getDataKecamatan(Request $request){
        $search = $request->input('q');
        $userData = Session::get('user');
        if(is_array($userData)){
            $kec_id = $userData['kec_id'];
        }
        else{
            $kec_id = '';
        }
        $data = PenetapanWr::getDataKecamatan($kec_id,$search);

        $formattedData = array_map(function ($item) {
            return [
                'id' => $item->id,
                'text' => $item->nama,
                'kode' => $item->kode
            ];
        }, $data);

        return response()->json($formattedData);
    }

    public function getDataKelurahan(Request $request){
        $search = $request->get('q', ''); 
        $kec_id = $request->get('kec_id', '');
        $data = penetapanWr::getDataKelurahan($kec_id,$search);

        $formattedData = array_map(function ($item) {
            return [
                'id' => $item->id,
                'text' => $item->nama,
                'kode' => $item->kode
            ];
        }, $data);

        return response()->json($formattedData);
    }

    public function getDataRw(Request $request){
        $search = $request->get('q', ''); 
        $kel_id = $request->get('kel_id', '');
        $data = penetapanWr::getDataRw($kel_id,$search);

        $formattedData = array_map(function ($item) {
            return [
                'id' => $item->id,
                'text' => $item->nama,
                'kode' => $item->kode
            ];
        }, $data);

        return response()->json($formattedData);
    }

    public function getDataRt(Request $request){
        $search = $request->get('q', ''); 
        $rw_id = $request->get('rw_id', '');
        $data = penetapanWr::getDataRt($rw_id,$search);

        $formattedData = array_map(function ($item) {
            return [
                'id' => $item->id,
                'text' => $item->nama,
                'kode' => $item->kode
            ];
        }, $data);

        return response()->json($formattedData);
    }

    public function getDataTarif(Request $request){
        $search = $request->get('q', ''); 
        $data = penetapanWr::getDataTarif($search);

        $formattedData = array_map(function ($item) {
            return [
                'id' => $item->id,
                'text' => $item->nama ." Rp. ".number_format($item->nilai,2,'.',','),
            ];
        }, $data);

        return response()->json($formattedData);
    }
    public function getDataWr(Request $request){
        if ($request->ajax()) {
            $kel_id = $request->get('kel_id', '');
            $data = PenetapanWr::select('id','nama')->where("kel_id",$kel_id);
            $no = 0;
            return DataTables::of($data)->addIndexColumn()->make(true);
        }
    }
    public function getMaxKode(Request $request){
        $rt_id = $request->get("rt_id","");
        $data = PenetapanWr::getMaxKode($rt_id);
        
        return response()->json($data);
    }
    public function getDataById(Request $request){
        $id = $request->get("id",'');
        $data = PenetapanWr::select('tr_wajib_retribusi.*','ms_tarif.nama as nm_tarif','ms_tarif.nilai as nilai')
        ->join('ms_tarif', 'tr_wajib_retribusi.tarif_id', '=', 'ms_tarif.id')
        ->where("tr_wajib_retribusi.id",$id)->get();
        return response()->json($data);
    }

    public function cetakAll(Request $request)
    {
        session_write_close();
        ini_set('memory_limit', -1);
		ini_set('max_execution_time', -1);
        $userData = Session::get('user');
        if(is_array($userData)){
            $kec_id = $userData['kec_id'];
        }
        else{
            $kec_id = '';
        }
        $data = PenetapanWr::getCetakSkrd($request->bulan,$request->tahun);
        $datax = DB::table('pimpinan_kecamatan')
        ->where('kec_id',$kec_id)
        ->where('jabatan','Camat')
        ->where('status','1')
        ->first();
        // $data='';
        $html = view('pdf.template', compact('data','datax'))->render();

        return SnappyPdf::loadHTML($html)
            ->setPaper('a4')
            ->setOption('margin-top', 10)
            // ->inline('laporan.pdf');
            // atau 
            ->download('laporan.pdf');
    }

    public function getAvailableMonths(Request $request)
    {
        $year = $request->get('year', date('Y'));

        // Full list of months
        $months = [
            ['id' => 1, 'text' => 'Januari'],
            ['id' => 2, 'text' => 'Februari'],
            ['id' => 3, 'text' => 'Maret'],
            ['id' => 4, 'text' => 'April'],
            ['id' => 5, 'text' => 'Mei'],
            ['id' => 6, 'text' => 'Juni'],
            ['id' => 7, 'text' => 'Juli'],
            ['id' => 8, 'text' => 'Agustus'],
            ['id' => 9, 'text' => 'September'],
            ['id' => 10, 'text' => 'Oktober'],
            ['id' => 11, 'text' => 'November'],
            ['id' => 12, 'text' => 'Desember'],
        ];
        $userData = Session::get('user');
        if(is_array($userData)){
            $kec_id = $userData['kec_id'];
        }
        else{
            $kec_id = '';
        }
        // Get months already in tr_penetapan for the year
        $usedMonths = $this->penetapanWr
            ->join("tr_wajib_retribusi", "tr_penetapan.wr_id", "=", "tr_wajib_retribusi.id")
            ->join("ms_rt", "tr_wajib_retribusi.rt_id", "=", "ms_rt.id")
            ->join("ms_rw", "ms_rt.rw_id", "=", "ms_rw.id")
            ->join("ms_kelurahan", "ms_rw.kel_id", "=", "ms_kelurahan.id")
            ->join("ms_kecamatan", "ms_kelurahan.kec_id", "=", "ms_kecamatan.id")
            ->where('tr_penetapan.tahun', $year)
            ->where("ms_kecamatan.id", $kec_id)
            ->distinct()
            ->pluck('tr_penetapan.periode')
            ->toArray();

        // Filter out used months
        $availableMonths = array_filter($months, function ($month) use ($usedMonths) {
            return !in_array($month['id'], $usedMonths);
        });

        return response()->json(array_values($availableMonths));
    }
}