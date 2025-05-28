<?php

namespace App\Http\Controllers;

use App\Models\MasterRt;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Session;

class MasterRtController extends Controller
{
    protected $masterRt;

    // Menggunakan dependency injection
    public function __construct(MasterRt $masterRt)
    {
        $this->masterRt = $masterRt;
    }
    public function index(){
        return view('master-rt');
    }
    public function save(Request $request){
        if($request->id == ''){
            $data = $this->masterRt->createRt($request->kode,$request->nama,$request->rw_id);
            if($data === true){
                $result = array('kode' => 1, "message" => "Data RT berhasil disimpan!");
            }
            else{
                $result = array('kode' => 0, "message" => "Data RT gagal tersimpan!");
            }
        }
        else{
            $data = $this->masterRt->updateRt($request->id,$request->kode,$request->nama,$request->rw_id);
            if($data > 0){
                $result = array('kode' => 1, "message" => "Data RT berhasil diupdate!");
            }
            else{
                $result = array('kode' => 0, "message" => "Data RT gagal terupdate!");
            }
        }

        return response()->json($result);

    }
    public function getData(Request $request){
        if ($request->ajax()) {
            $data = MasterRt::select('ms_rt.*','ms_rw.nama as rw','ms_rw.kel_id','ms_kelurahan.nama as kelurahan','ms_kelurahan.kec_id','ms_kecamatan.nama as kecamatan')
            ->join('ms_rw', 'ms_rt.rw_id', '=', 'ms_rw.id')
            ->join('ms_kelurahan', 'ms_rw.kel_id', '=', 'ms_kelurahan.id')
            ->join('ms_kecamatan', 'ms_kelurahan.kec_id', '=', 'ms_kecamatan.id')
            ->where('ms_rt.rw_id', $request->rw_id);
            $no = 0;
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
       
                    $btn = '<a class="edit btn btn-warning btn-sm" data-id="'.$row->id.'" data-kode="'.$row->kode.'" data-nama="'.$row->nama.'"><span class="fa fa-pencil-alt"></span>&nbsp;Edit</a> &nbsp; 
                        <a class="delete btn btn-danger btn-sm" data-id="'.$row->id.'"><span class="fa fa-trash"></span>&nbsp;Delete</a>
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
        $data = MasterRt::getDataKecamatan($kec_id,$search);

        $formattedData = array_map(function ($item) {
            return [
                'id' => $item->id,
                'text' => $item->nama,
            ];
        }, $data);

        return response()->json($formattedData);
    }

    public function getDataKelurahan(Request $request){
        $search = $request->get('q', ''); 
        $kec_id = $request->get('kec_id', '');
        $data = MasterRt::getDataKelurahan($kec_id,$search);

        $formattedData = array_map(function ($item) {
            return [
                'id' => $item->id,
                'text' => $item->nama,
            ];
        }, $data);

        return response()->json($formattedData);
    }

    public function getDataRw(Request $request){
        $search = $request->get('q', ''); 
        $kel_id = $request->get('kel_id', '');
        $data = MasterRt::getDataRw($kel_id,$search);

        $formattedData = array_map(function ($item) {
            return [
                'id' => $item->id,
                'text' => $item->nama,
            ];
        }, $data);

        return response()->json($formattedData);
    }

}
