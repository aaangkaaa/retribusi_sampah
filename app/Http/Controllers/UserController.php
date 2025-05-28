<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index()
    {
        return view('master-user');
    }

    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $data = User::select('users.*', 'ms_kecamatan.nama as kecamatan', 'ms_kelurahan.nama as kelurahan')
                ->leftJoin('ms_kecamatan', 'users.kec_id', '=', 'ms_kecamatan.id')
                ->leftJoin('ms_kelurahan', 'users.kel_id', '=', 'ms_kelurahan.id');

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<a class="edit btn btn-warning btn-sm" title="Edit Data" data-id="'.$row->id.'"><span class="fa fa-pencil-alt"></span></a> &nbsp; 
                            <a class="delete btn btn-danger btn-sm" title="Hapus Data" data-id="'.$row->id.'"><span class="fa fa-trash"></span></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function save(Request $request)
    {
        try {
            if($request->id == '') {
                // Validasi email unik untuk user baru
                $existingUser = User::where('email', $request->email)->first();
                if($existingUser) {
                    return response()->json(['kode' => 0, 'message' => 'Email sudah terdaftar!']);
                }

                $user = new User();
                $user->name = $request->name;
                $user->email = $request->email;
                $user->password = Hash::make($request->password);
                $user->kec_id = $request->kec_id;
                $user->kel_id = $request->kel_id;
                $user->role_id = $request->role_id;
                $user->is_active = $request->is_active;
                
                if($user->save()) {
                    return response()->json(['kode' => 1, 'message' => 'Data user berhasil disimpan!']);
                }
                return response()->json(['kode' => 0, 'message' => 'Data user gagal disimpan!']);
            } else {
                // Validasi email unik untuk update, kecuali untuk user yang sedang diedit
                $existingUser = User::where('email', $request->email)
                    ->where('id', '!=', $request->id)
                    ->first();
                if($existingUser) {
                    return response()->json(['kode' => 0, 'message' => 'Email sudah terdaftar!']);
                }

                $user = User::find($request->id);
                if(!$user) {
                    return response()->json(['kode' => 0, 'message' => 'User tidak ditemukan!']);
                }

                $user->name = $request->name;
                $user->email = $request->email;
                if($request->password != '') {
                    $user->password = Hash::make($request->password);
                }
                $user->kec_id = $request->kec_id;
                $user->kel_id = $request->kel_id;
                $user->role_id = $request->role_id;
                $user->is_active = $request->is_active;
                
                if($user->save()) {
                    return response()->json(['kode' => 1, 'message' => 'Data user berhasil diupdate!']);
                }
                return response()->json(['kode' => 0, 'message' => 'Data user gagal diupdate!']);
            }
        } catch (\Exception $e) {
            return response()->json(['kode' => 0, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    public function getDataById(Request $request)
    {
        $id = $request->get('id');
        $data = User::select('users.*', 'ms_kecamatan.nama as kecamatan', 'ms_kelurahan.nama as kelurahan', 'roles.nama as role')
            ->leftJoin('ms_kecamatan', 'users.kec_id', '=', 'ms_kecamatan.id')
            ->leftJoin('ms_kelurahan', 'users.kel_id', '=', 'ms_kelurahan.id')
            ->leftJoin('roles', 'users.role_id', '=', 'roles.id')
            ->where('users.id', $id)
            ->first();
        return response()->json($data);
    }

    public function delete(Request $request)
    {
        $id = $request->get('id');
        $user = User::find($id);
        
        if($user->delete()) {
            return response()->json(['kode' => 1, 'message' => 'Data user berhasil dihapus!']);
        }
        return response()->json(['kode' => 0, 'message' => 'Data user gagal dihapus!']);
    }

    public function dataRole(Request $request)
    {
        $q = $request->get('q');
        $roles = \App\Models\Role::where('is_active', 1)
            ->when($q, function($query) use ($q) {
                $query->where('nama', 'like', "%$q%") ;
            })
            ->orderBy('nama')
            ->get();
        $result = $roles->map(function($role) {
            return [
                'id' => $role->id,
                'text' => $role->nama
            ];
        });
        return response()->json($result);
    }

    public function getDataKecamatan(Request $request){
        $search = $request->input('q');
        $userData = session()->get('user');
        if(is_array($userData)){
            $kec_id = $userData['kec_id'];
        } else {
            $kec_id = '';
        }
        $data = User::getDataKecamatan($kec_id, $search);
        $formattedData = array_map(function ($item) {
            return [
                'id' => $item->id,
                'text' => $item->nama,
                'kode' => $item->kode ?? null
            ];
        }, $data);
        return response()->json($formattedData);
    }
} 