<?php

namespace App\Http\Controllers;

use App\Models\PimpinanKecamatan;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class PimpinanKecamatanController extends Controller
{
    public function index()
    {
        return view('pimpinan-kecamatan');
    }

    public function getData(Request $request)
    {
        $userData = Session::get('user');
        if(is_array($userData)){
            $kec_id = $userData['kec_id'];
        }
        else{
            $kec_id = '';
        }
        $data = PimpinanKecamatan::select(
            'pimpinan_kecamatan.id',
            'ms_kecamatan.nama as kecamatan',
            'pimpinan_kecamatan.nip',
            'pimpinan_kecamatan.nama',
            'pimpinan_kecamatan.jabatan',
            DB::raw("IF(pimpinan_kecamatan.status='1','Aktif','Tidak Aktif') as status")
        )
        ->join('ms_kecamatan', 'pimpinan_kecamatan.kec_id', '=', 'ms_kecamatan.id')
        ->where('pimpinan_kecamatan.kec_id', $kec_id);
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                return '<button class="btn btn-sm btn-primary edit" data-id="'.$row->id.'" data-nip="'.$row->nip.'" data-nama="'.$row->nama.'" data-jabatan="'.$row->jabatan.'" data-status="'.$row->status.'">Edit</button>'.
                '<button class="btn btn-sm btn-danger delete" data-id="'.$row->id.'">Delete</button>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function save(Request $request)
    {
        $data = $request->only(['id', 'kec_id', 'nip', 'nama', 'jabatan', 'status']);
        if (isset($data['status']) && $data['status'] == 1) {
            PimpinanKecamatan::where('kec_id', $data['kec_id'])
                ->where('id', '!=', $data['id'] ?? 0)
                ->update(['status' => 0]);
        }
        if (!empty($data['id'])) {
            $pimpinan_kecamatan = PimpinanKecamatan::find($data['id']);
            if ($pimpinan_kecamatan) {
                $pimpinan_kecamatan->update($data);
                return response()->json(['status' => 'success', 'message' => 'Data berhasil diupdate']);
            }
        } else {
            PimpinanKecamatan::create($data);
            return response()->json(['status' => 'success', 'message' => 'Data berhasil disimpan']);
        }
        return response()->json(['status' => 'error', 'message' => 'Data gagal disimpan']);
    }
    public function delete(Request $request)
    {
        $id = $request->get('id');
        $pimpinan_kecamatan = PimpinanKecamatan::find($id);
        if ($pimpinan_kecamatan) {
            $pimpinan_kecamatan->delete();
            return response()->json(['status' => 'success', 'message' => 'Data berhasil dihapus']);
        }
        return response()->json(['status' => 'error', 'message' => 'Data gagal dihapus']);
    }
} 