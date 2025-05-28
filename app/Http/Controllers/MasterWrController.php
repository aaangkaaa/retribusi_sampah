<?php

namespace App\Http\Controllers;

use App\Models\MasterWr;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class MasterWrController extends Controller
{
    protected $masterWr;

    // Menggunakan dependency injection
    public function __construct(MasterWr $masterWr)
    {
        $this->masterWr = $masterWr;
    }
    public function index(){
        return view('master-wr');
    }
    public function save(Request $request){
        $rt_id =  Session::get('rt_id');
        if($rt_id == ""){
            $rt_id = $request->rt_id;
        }
        if($request->id == ''){
            // Cek NPWR unik
            $npwr = $request->npwr;
            $base = substr($npwr, 0, -4);
            $last4 = (int)substr($npwr, -4);
            $exists = DB::table('tr_wajib_retribusi')->where('npwr', $npwr)->exists();
            $npwr_baru = null;
            while ($exists) {
                $last4++;
                $npwr = $base . str_pad($last4, 4, '0', STR_PAD_LEFT);
                $exists = DB::table('tr_wajib_retribusi')->where('npwr', $npwr)->exists();
                $npwr_baru = $npwr;
            }
            $data = $this->masterWr->createWr($npwr,$request->nama,$request->alamat,$request->rt_id,$request->kontak,$request->tarif_id,$request->status,$request->nop,$request->no_kk,$request->kwh);
            if($data === true){
                $result = array('kode' => 1, "message" => "Data RW berhasil disimpan!");
                if($npwr_baru && $npwr_baru != $request->npwr) {
                    $result['npwr_baru'] = $npwr_baru;
                }
            }
            else{
                $result = array('kode' => 0, "message" => "Data RW gagal tersimpan!");
            }
        }
        else{
            $data = $this->masterWr->updateWr($request->id, $request->nama, $request->alamat, $request->kontak , $request->tarif_id , $request->status, $request->nop, $request->no_kk, $request->kwh);
            if($data > 0){
                $result = array('kode' => 1, "message" => "Data RW berhasil diupdate!");
            }
            else{
                $result = array('kode' => 0, "message" => "Data RW gagal terupdate!");
            }
        }

        return response()->json($result);

    }
    public function getData(Request $request){
        if ($request->ajax()) {
            $data = MasterWr::select('tr_wajib_retribusi.*','ms_kecamatan.id as kec_id','ms_kecamatan.nama as kecamatan','ms_kelurahan.id as kel_id','ms_kelurahan.nama as kelurahan','ms_rw.id as rw_id','ms_rw.nama as rw','ms_rt.nama as rt')
            ->join('ms_rt', 'tr_wajib_retribusi.rt_id', '=', 'ms_rt.id')
            ->join('ms_rw', 'ms_rt.rw_id', '=', 'ms_rw.id')
            ->join('ms_kelurahan', 'ms_rw.kel_id', '=', 'ms_kelurahan.id')
            ->join('ms_kecamatan', 'ms_kelurahan.kec_id', '=', 'ms_kecamatan.id')
            ->where('tr_wajib_retribusi.rt_id',$request->input("rt_id"));
            $no = 0;
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
       
                    $btn = '<a class="edit btn btn-warning btn-sm" title="Edit Data" data-id="'.$row->id.'"><span class="fa fa-pencil-alt"></span></a> &nbsp; 
                        <a class="delete btn btn-danger btn-sm" title="Hapus Data" data-id="'.$row->id.'"><span class="fa fa-trash"></span></a>
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
        $data = MasterWr::getDataKecamatan($kec_id,$search);

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
        $data = masterWr::getDataKelurahan($kec_id,$search);

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
        $data = masterWr::getDataRw($kel_id,$search);

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
        $data = masterWr::getDataRt($rw_id,$search);

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
        $data = masterWr::getDataTarif($search);

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
            $data = MasterWr::select('id','nama')->where("kel_id",$kel_id);
            $no = 0;
            return DataTables::of($data)->addIndexColumn()->make(true);
        }
    }
    public function getMaxKode(Request $request){
        $rt_id = $request->get("rt_id","");
        $data = MasterWr::getMaxKode($rt_id);
        
        return response()->json($data);
    }
    public function getDataById(Request $request){
        $id = $request->get("id",'');
        $data = MasterWr::select('tr_wajib_retribusi.*','ms_tarif.nama as nm_tarif','ms_tarif.nilai as nilai')
        ->join('ms_tarif', 'tr_wajib_retribusi.tarif_id', '=', 'ms_tarif.id')
        ->where("tr_wajib_retribusi.id",$id)->get();
        return response()->json($data);
    }
} 
