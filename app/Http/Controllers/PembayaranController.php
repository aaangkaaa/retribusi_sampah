<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PenetapanWr;
use App\Models\Pembayaran;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Barryvdh\Snappy\Facades\SnappyPdf;

class PembayaranController extends Controller
{
    public function index()
    {
        return view('m-pembayaran');
    }

    public function getData(Request $request)
    {
        $data = Pembayaran::select(
            'tr_pembayaran.id',
            'tr_pembayaran.wr_id',
            'a.npwr',
            'a.nama',
            'tr_pembayaran.tgl_pembayaran',
            'tr_pembayaran.jumlah',
            'tr_pembayaran.keterangan'
        )
        ->leftJoin('tr_wajib_retribusi AS a', 'tr_pembayaran.wr_id', '=', 'a.id')
        ->orderBy('tr_pembayaran.tgl_pembayaran', 'desc');
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                return '
                    <button class="btn btn-sm btn-danger cetak-stbp" data-id="'.$row->id.'"><i class="fa fa-file-pdf"></i>&nbsp;Cetak STBP</button>
                    <button class="btn btn-sm btn-primary detail" data-id="'.$row->id.'"><i class="fa fa-eye"></i>&nbsp;Detail</button> 
                    <button class="btn btn-sm btn-danger delete" data-id="'.$row->id.'"><i class="fa fa-trash"></i>&nbsp;Hapus</button>
                ';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function getDataDet(Request $request)
    {
        $wr_id = $request->wr_id;
        
        $subQuery = DB::table('trd_pembayaran')
            ->select(DB::raw('SUM(total_pembayaran) as total_pembayaran, penetapan_id'))
            ->groupBy('penetapan_id');

        $data = DB::table('tr_penetapan AS a')
            ->leftJoin('ms_tarif AS b', 'a.tarif_id', '=', 'b.id')
            ->leftJoin(DB::raw('(' . $subQuery->toSql() . ') as c'), function($join) {
                $join->on('a.id', '=', 'c.penetapan_id');
            })
            ->select(
                'a.id',
                'a.id as penetapan_id',
                'a.no_seri',
                'a.tahun',
                'a.periode as bulan',
                DB::raw('b.nilai-IFNULL(c.total_pembayaran, 0) as tagihan'),
                DB::raw('0 as total_pembayaran'),
                'b.nilai',
                'a.tgl_penetapan',
                'a.tgl_tempo'
            )
            ->where('a.wr_id', $wr_id)
            ->whereRaw('b.nilai > IFNULL(c.total_pembayaran, 0)');

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                return '<button class="btn btn-sm btn-primary bayar" data-id="'.$row->penetapan_id.'"><i class="fa fa-money"></i> Bayar</button>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function save(Request $request)
    {
        try {
            DB::beginTransaction();

            // Validate request
            $validated = $request->validate([
                'wr_id' => 'required|exists:tr_wajib_retribusi,id',
                'tgl_pembayaran' => 'required|date',
                'jumlah' => 'required|numeric|min:0',
                'keterangan' => 'nullable|string',
                'details' => 'required|array|min:1',
                'details.*.penetapan_id' => 'required|exists:tr_penetapan,id',
                'details.*.total_pembayaran' => 'required|numeric|min:0',
            ]);

            // Create main payment record
            $pembayaran = Pembayaran::create([
                'wr_id' => $validated['wr_id'],
                'tgl_pembayaran' => $validated['tgl_pembayaran'],
                'jumlah' => $validated['jumlah'],
                'keterangan' => $validated['keterangan'] ?? null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Create payment details
            $details = collect($validated['details'])->map(function($detail) use ($pembayaran) {
                return [
                    'pembayaran_id' => $pembayaran->id,
                    'penetapan_id' => $detail['penetapan_id'],
                    'total_pembayaran' => $detail['total_pembayaran'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            });

            DB::table('trd_pembayaran')->insert($details->toArray());

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Data pembayaran berhasil disimpan',
            ]);

        } catch (\Exception $e) {
            DB::rollback();
            
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function autocomplete(Request $request)
    {
        $search = $request->q;
        $userData = Session::get('user');
        if(is_array($userData)){
            $kec_id = $userData['kec_id'];
            $kel_id = $userData['kel_id'];
        }
        else{
            $kec_id = '';
            $kel_id = '';
        }
        $data = DB::table('tr_wajib_retribusi')
        ->where(function($query) use ($search) {
            $query->where('tr_wajib_retribusi.nama', 'like', "%$search%")
            ->orWhere('tr_wajib_retribusi.npwr', 'like', "%$search%");
        })
        ->select('tr_wajib_retribusi.id', DB::raw('concat(tr_wajib_retribusi.npwr," - ",tr_wajib_retribusi.nama) as text'))
        ->join('ms_rt', 'tr_wajib_retribusi.rt_id', '=', 'ms_rt.id')
        ->join('ms_rw', 'ms_rt.rw_id', '=', 'ms_rw.id')
        ->join('ms_kelurahan', 'ms_rw.kel_id', '=', 'ms_kelurahan.id')
        ->join('ms_kecamatan', 'ms_kelurahan.kec_id', '=', 'ms_kecamatan.id')
        ->where('ms_kecamatan.id',$kec_id)
        ->when(!empty($kel_id), function ($query) use ($kel_id) {
            $query->where('ms_kelurahan.id', $kel_id);
        })
        ->limit(20)
        ->get();
        return response()->json($data);
    }
    public function cetakStbp(Request $request)
    {
        session_write_close();
        ini_set('memory_limit', -1);
		ini_set('max_execution_time', -1);
        $data = Pembayaran::getCetakStbp($request->id);
        // $data='';
        $html = view('pdf.stbp', compact('data'))->render();

        return SnappyPdf::loadHTML($html)
            ->setPaper('a4')
            ->setOption('margin-top', 10)
            ->inline('stbp.pdf'); // atau ->download('stbp.pdf');
    }
} 