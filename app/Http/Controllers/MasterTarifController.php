<?php

namespace App\Http\Controllers;
use App\Models\MasterTarif;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MasterTarifController extends Controller
{
    protected $masterTarif;

    // Menggunakan dependency injection
    public function __construct(MasterTarif $masterTarif)
    {
        $this->masterTarif = $masterTarif;
    }

    public function index(){
        return view('master-tarif');
    }

    public function save(Request $request){
        if($request->id == ''){
            $data = $this->masterTarif->createTarif($request->nama,$request->nilai);
            if($data === true){
                $result = array('kode' => 1, "message" => "Data Tarif berhasil disimpan!");
            }
            else{
                $result = array('kode' => 0, "message" => "Data Tarif gagal tersimpan!");
            }
        }
        else{
            $data = $this->masterTarif->updateTarif($request->id,$request->nama,$request->nilai);
            if($data > 0){
                $result = array('kode' => 1, "message" => "Data Tarif berhasil diupdate!");
            }
            else{
                $result = array('kode' => 0, "message" => "Data Tarif gagal terupdate!");
            }
        }

        return response()->json($result);

    }

    public function getData(Request $request){
        if ($request->ajax()) {
            $data = MasterTarif::select('*');
            $no = 0;
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
       
                    $btn = '<a class="edit btn btn-warning btn-sm" data-id="'.$row->id.'" data-nilai="'.$row->nilai.'" data-nama="'.$row->nama.'"><span class="fa fa-pencil-alt"></span>&nbsp;Edit</a> &nbsp; 
                        <a class="delete btn btn-danger btn-sm" data-id="'.$row->id.'"><span class="fa fa-trash"></span>&nbsp;Delete</a>
                    ';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        try {
            $tarif = $this->masterTarif->findOrFail($id);
            // This will trigger the boot method and deleting event in the model
            $tarif->delete();
            return response()->json(['kode' => 1, 'message' => 'Data Tarif berhasil dihapus!']);
        } catch (\Exception $e) {
            return response()->json(['kode' => 0, 'message' => 'Data Tarif gagal dihapus! ' . $e->getMessage()]);
        }
    }
}
