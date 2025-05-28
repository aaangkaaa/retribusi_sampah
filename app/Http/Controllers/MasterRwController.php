<?php

namespace App\Http\Controllers;

use App\Models\MasterRw;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Session;

class MasterRwController extends Controller
{
    protected $masterRw;

    // Menggunakan dependency injection
    public function __construct(MasterRw $masterRw)
    {
        $this->masterRw = $masterRw;
    }
    public function index(){
        return view('master-rw');
    }
    public function save(Request $request){
        $kel_id =  Session::get('kel_id');
        if($kel_id == ""){
            $kel_id = $request->kel_id;
        }
        if($request->id == ''){
            $data = $this->masterRw->createRw($request->kode,$request->nama,$request->singkatan,$kel_id);
            if($data === true){
                $result = array('kode' => 1, "message" => "Data RW berhasil disimpan!");
            }
            else{
                $result = array('kode' => 0, "message" => "Data RW gagal tersimpan!");
            }
        }
        else{
            $data = $this->masterRw->updateRw($request->id,$request->kode,$request->nama,$request->singkatan,$kel_id);
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
            $data = MasterRw::select('ms_rw.*','ms_kecamatan.id as kec_id','ms_kecamatan.nama as kecamatan','ms_kelurahan.nama as kelurahan')
            ->join('ms_kelurahan', 'ms_rw.kel_id', '=', 'ms_kelurahan.id')
            ->join('ms_kecamatan', 'ms_kelurahan.kec_id', '=', 'ms_kecamatan.id');
            $no = 0;
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
       
                    $btn = '<a class="edit btn btn-warning btn-sm" data-id="'.$row->id.'" data-kode="'.$row->kode.'" data-nama="'.$row->nama.'" data-kec-id="'.$row->kec_id.'" data-kel-id="'.$row->kel_id.'"><span class="fa fa-pencil-alt"></span>&nbsp;Edit</a> &nbsp; 
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
        $data = MasterRw::getDataKecamatan($kec_id,$search);

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
        $data = masterRw::getDataKelurahan($kec_id,$search);

        $formattedData = array_map(function ($item) {
            return [
                'id' => $item->id,
                'text' => $item->nama,
            ];
        }, $data);

        return response()->json($formattedData);
    }
    public function getDataRw(Request $request){
        if ($request->ajax()) {
            $kel_id = $request->get('kel_id', '');
            $data = MasterRw::select('id','nama')->where("kel_id",$kel_id);
            $no = 0;
            return DataTables::of($data)->addIndexColumn()->make(true);
        }
    }
} 
