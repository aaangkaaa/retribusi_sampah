<?php

namespace App\Http\Controllers;

use App\Models\MasterKelurahan;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MasterKelurahanController extends Controller
{
    protected $masterKelurahan;

    // Menggunakan dependency injection
    public function __construct(MasterKelurahan $masterKelurahan)
    {
        $this->masterKelurahan = $masterKelurahan;
    }
    public function index(){
        return view('master-kelurahan');
    }
    public function save(Request $request){
        if($request->id == ''){
            $data = $this->masterKelurahan->createKelurahan($request->kode,$request->nama,$request->singkatan);
            if($data === true){
                $result = array('kode' => 1, "message" => "Data Kelurahan berhasil disimpan!");
            }
            else{
                $result = array('kode' => 0, "message" => "Data Kelurahan gagal tersimpan!");
            }
        }
        else{
            $data = $this->masterKelurahan->updateKelurahan($request->id,$request->kode,$request->nama,$request->singkatan);
            if($data > 0){
                $result = array('kode' => 1, "message" => "Data Kelurahan berhasil diupdate!");
            }
            else{
                $result = array('kode' => 0, "message" => "Data Kelurahan gagal terupdate!");
            }
        }

        return response()->json($result);

    }
    public function getData(Request $request){
        if ($request->ajax()) {
            $data = MasterKelurahan::select('*');
            $no = 0;
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
       
                    $btn = '<a class="edit btn btn-warning btn-sm" data-id="'.$row->id.'" data-kode="'.$row->kode.'" data-nama="'.$row->nama.'" data-singkatan="'.$row->singkatan.'"><span class="fa fa-pencil-alt"></span>&nbsp;Edit</a> &nbsp; 
                        <a class="delete btn btn-danger btn-sm" data-id="'.$row->id.'"><span class="fa fa-trash"></span>&nbsp;Delete</a>
                    ';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
