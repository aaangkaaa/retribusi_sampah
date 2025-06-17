<?php


namespace App\Http\Controllers;

use App\Models\Kolektor;
use App\Models\MasterKecamatan;
use App\Models\MasterKelurahan;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Session;

class MasterKolektorController extends Controller
{
    protected $kolektor;

    public function __construct(Kolektor $kolektor)
    {
        $this->kolektor = $kolektor;
    }

    public function index()
    {
        return view('m-kolektor');
    }

    public function save(Request $request)
    {
        $kel_id = Session::get('kel_id');
        if ($kel_id == "") {
            $kel_id = $request->kel_id;
        }
        if ($request->id == '') {
            if($request->status == 1) {
                $this->kolektor->where('kel_id', $kel_id)->update(['status' => 0]);
            } 
            $data = $this->kolektor->create([
                'kel_id' => $kel_id,
                'nama' => $request->nama,
                'nik' => $request->nik,
                'status' => $request->status,
            ]);
            
            if ($data) {
                $result = ['kode' => 1, 'message' => 'Data Kolektor berhasil disimpan!'];
            } else {
                $result = ['kode' => 0, 'message' => 'Data Kolektor gagal tersimpan!'];
            }
        } else {
            
            if($request->status == 1) {
                $this->kolektor->where('kel_id', $kel_id)->where('id','!=',$request->id)->update(['status' => 0]);
            } 
            $data = $this->kolektor->where('id', $request->id)->update([
                'kel_id' => $kel_id,
                'nama' => $request->nama,
                'nik' => $request->nik,
                'status' => $request->status,
            ]);
            if ($data > 0) {
                $result = ['kode' => 1, 'message' => 'Data Kolektor berhasil diupdate!'];
            } else {
                $result = ['kode' => 0, 'message' => 'Data Kolektor gagal terupdate!'];
            }
        }

        return response()->json($result);
    }

    public function updateStatus(Request $request)
    {
        $id = $request->id;
        $status = $request->status;
        if($status == 'Aktif') {
            $status = 1;
            // Jika status diubah menjadi aktif, update semua kolektor dengan kel_id yang sama kecuali kolektor ini menjadi status 0
            $kolektor = $this->kolektor->find($id);
            if ($kolektor) {
                $this->kolektor->where('kel_id', $kolektor->kel_id)
                    ->where('id', '!=', $id)
                    ->update(['status' => 0]);
            }
        } else {
            $status = 0;
        }

        $data = $this->kolektor->where('id', $id)->update(['status' => $status]);

        if ($data > 0) {
            $result = ['kode' => 1, 'message' => 'Status Kolektor berhasil diupdate!'];
        } else {
            $result = ['kode' => 0, 'message' => 'Status Kolektor gagal diupdate!'];
        }

        return response()->json($result);
    }

    public function getData(Request $request)
    {
        $userData = Session::get('user');
        if (is_array($userData)) {
            $kec_id = $userData['kec_id'];
        } else {
            $kec_id = '';
        }
        if ($request->ajax()) {
            $search = $request->get('search')['value'] ?? '';
            $start = $request->get('start', 0);
            $length = $request->get('length', 10);
            $draw = $request->get('draw', 1);

            // Base query for filtered count
            $baseQuery = Kolektor::query()->where('ms_kecamatan.id', $kec_id)
                ->select('kolektor.*', 'ms_kelurahan.nama as kelurahan', 'ms_kecamatan.id as kec_id', 'ms_kecamatan.nama as kecamatan')
                ->join('ms_kelurahan', 'kolektor.kel_id', '=', 'ms_kelurahan.id')
                ->join('ms_kecamatan', 'ms_kelurahan.kec_id', '=', 'ms_kecamatan.id');

            if ($search) {
                $searchLower = strtolower($search);
                $baseQuery->where(function ($q) use ($searchLower) {
                    $q->whereRaw('LOWER(kolektor.nama) like ?', ["%{$searchLower}%"])
                        ->orWhereRaw('LOWER(kolektor.nik) like ?', ["%{$searchLower}%"])
                        ->orWhereRaw('LOWER(ms_kelurahan.nama) like ?', ["%{$searchLower}%"])
                        ->orWhereRaw('LOWER(ms_kecamatan.nama) like ?', ["%{$searchLower}%"]);
                });
            }

            $totalFiltered = $baseQuery->count();
            $totalData = Kolektor::query()->where('ms_kecamatan.id', $kec_id)
                ->join('ms_kelurahan', 'kolektor.kel_id', '=', 'ms_kelurahan.id')
                ->join('ms_kecamatan', 'ms_kelurahan.kec_id', '=', 'ms_kecamatan.id')
                ->count();

            // Full query with joins for data retrieval with pagination
            $query = Kolektor::query()
                ->select('kolektor.*', 'ms_kelurahan.nama as kelurahan', 'ms_kecamatan.id as kec_id', 'ms_kecamatan.nama as kecamatan')
                ->join('ms_kelurahan', 'kolektor.kel_id', '=', 'ms_kelurahan.id')
                ->join('ms_kecamatan', 'ms_kelurahan.kec_id', '=', 'ms_kecamatan.id')
                ->where('ms_kecamatan.id', $kec_id);

            if ($search) {
                $searchLower = strtolower($search);
                $query->where(function ($q) use ($searchLower) {
                    $q->whereRaw('LOWER(kolektor.nama) like ?', ["%{$searchLower}%"])
                        ->orWhereRaw('LOWER(kolektor.nik) like ?', ["%{$searchLower}%"])
                        ->orWhereRaw('LOWER(ms_kelurahan.nama) like ?', ["%{$searchLower}%"])
                        ->orWhereRaw('LOWER(ms_kecamatan.nama) like ?', ["%{$searchLower}%"]);
                });
            }

            $data = $query->offset($start)->limit($length)->get();

            $index = $start + 1;
            $data->transform(function ($row) use (&$index) {
                $row->DT_RowIndex = $index++;
                $row->action = '<a class="edit btn btn-warning btn-sm" data-id="' . $row->id . '" data-nik="' . $row->nik . '" data-nama="' . $row->nama . '" data-status="' . $row->status . '" data-kel-id="' . $row->kel_id . '" data-kec-id="' . $row->kec_id . '" data-kec-nama="' . $row->kecamatan . '" data-kel-nama="' . $row->kelurahan . '"><span class="fa fa-pencil-alt"></span>&nbsp;Edit</a> &nbsp; 
                            <a class="delete btn btn-danger btn-sm" data-id="' . $row->id . '"><span class="fa fa-trash"></span>&nbsp;Delete</a>';
                return $row;
            });

            return response()->json([
                'draw' => intval($draw),
                'recordsTotal' => $totalData,
                'recordsFiltered' => $totalFiltered,
                'data' => $data,
            ]);
        }
    }

    public function getDataKecamatan(Request $request)
    {
        $search = $request->input('q');
        $userData = Session::get('user');
        if (is_array($userData)) {
            $kec_id = $userData['kec_id'];
        } else {
            $kec_id = '';
        }
        $data = MasterKecamatan::where('id', $kec_id)
            ->where('nama', 'like', '%' . $search . '%')
            ->get()
            ->toArray();

        $formattedData = array_map(function ($item) {
            return [
                'id' => $item['id'],
                'text' => $item['nama'],
            ];
        }, $data);

        return response()->json($formattedData);
    }

    public function getDataKelurahan(Request $request)
    {
        $search = $request->get('q', '');
        $kec_id = $request->get('kec_id', '');
        $data = MasterKelurahan::where('kec_id', $kec_id)
            ->where('nama', 'like', '%' . $search . '%')
            ->get()
            ->toArray();

        $formattedData = array_map(function ($item) {
            return [
                'id' => $item['id'],
                'text' => $item['nama'],
            ];
        }, $data);

        return response()->json($formattedData);
    }

    public function getDataKolektor(Request $request)
    {
        if ($request->ajax()) {
            $kel_id = $request->get('kel_id', '');
            $data = Kolektor::select('id', 'nama')->where('kel_id', $kel_id);
            return DataTables::of($data)->addIndexColumn()->make(true);
        }
    }
}
