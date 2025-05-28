<?php

namespace App\Http\Controllers;
use App\Models\MasterKeacamatan;
use App\Models\MasterKecamatan;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MasterKecamatanController extends Controller
{
    protected $masterKecamatan;

    // Menggunakan dependency injection
    public function __construct(MasterKecamatan $masterKecamatan)
    {
        $this->masterKecamatan = $masterKecamatan;
    }
    public function index(){
        return view('master-kecamatan');
    }
    public function save(Request $request){
        if($request->id == ''){
            $data = $this->masterKecamatan->createKecamatan($request->kode,$request->nama);
            if($data === true){
                $result = array('kode' => 1, "message" => "Data Kecamatan berhasil disimpan!");
            }
            else{
                $result = array('kode' => 0, "message" => "Data Kecamatan gagal tersimpan!");
            }
        }
        else{
            $data = $this->masterKecamatan->updateKecamatan($request->id,$request->kode,$request->nama);
            if($data > 0){
                $result = array('kode' => 1, "message" => "Data Kecamatan berhasil diupdate!");
            }
            else{
                $result = array('kode' => 0, "message" => "Data Kecamatan gagal terupdate!");
            }
        }

        return response()->json($result);

    }
    public function getData(Request $request){
        if ($request->ajax()) {
            $data = MasterKecamatan::select('*');
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
}
