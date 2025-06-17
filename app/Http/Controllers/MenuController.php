<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\UserMenu;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MenuController extends Controller
{
    public function index()
    {
        return view('master-menu');
    }

    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $data = Menu::select('menu.*', 'parent.nama as parent_nama')
                ->leftJoin('menu as parent', 'menu.parent_id', '=', 'parent.id');

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
        if($request->id == '') {
            Menu::where('parent_id', $request->parent_id)
                ->where('urutan', '>=', $request->urutan)
                ->increment('urutan');

            $menu = new Menu();
            $menu->nama = $request->nama;
            $menu->icon = $request->icon;
            $menu->url = $request->url;
            $menu->parent_id = $request->parent_id;
            $menu->urutan = $request->urutan;
            $menu->is_active = $request->is_active;
            
            if($menu->save()) {
                return response()->json(['kode' => 1, 'message' => 'Data menu berhasil disimpan!']);
            }
            return response()->json(['kode' => 0, 'message' => 'Data menu gagal disimpan!']);
        } else {
            Menu::where('parent_id', $request->parent_id)
                ->where('urutan', '>=', $request->urutan)
                ->where('id', '!=', $request->id)
                ->increment('urutan');

            $menu = Menu::find($request->id);
            $menu->nama = $request->nama;
            $menu->icon = $request->icon;
            $menu->url = $request->url;
            $menu->parent_id = $request->parent_id;
            $menu->urutan = $request->urutan;
            $menu->is_active = $request->is_active;
            
            if($menu->save()) {
                return response()->json(['kode' => 1, 'message' => 'Data menu berhasil diupdate!']);
            }
            return response()->json(['kode' => 0, 'message' => 'Data menu gagal diupdate!']);
        }
    }

    public function getDataById(Request $request)
    {
        $id = $request->get('id');
        $data = Menu::find($id);
        if ($data && $data->parent_id) {
            $parent = Menu::find($data->parent_id);
            $data->parent_nama = $parent ? $parent->nama : null;
        } else {
            $data->parent_nama = null;
        }
        return response()->json($data);
    }

    public function delete(Request $request)
    {
        $id = $request->get('id');
        $menu = Menu::find($id);
        
        if($menu->delete()) {
            return response()->json(['kode' => 1, 'message' => 'Data menu berhasil dihapus!']);
        }
        return response()->json(['kode' => 0, 'message' => 'Data menu gagal dihapus!']);
    }

    public function getParentMenu()
    {
        $data = Menu::where('parent_id', null)->get();

        // Ubah data agar sesuai format Select2 (id, text)
        $formattedData = $data->map(function ($item) {
            return [
                'id' => $item->id,
                'text' => $item->nama,
                'icon' => $item->icon,
            ];
        });

        return response()->json($formattedData);
    }

    public function saveUserMenu(Request $request)
    {
        $user_id = $request->user_id;
        $menu_permissions = $request->menu_permissions;

        // Delete existing permissions
        UserMenu::where('user_id', $user_id)->delete();

        // Insert new permissions
        foreach($menu_permissions as $permission) {
            $userMenu = new UserMenu();
            $userMenu->user_id = $user_id;
            $userMenu->menu_id = $permission['menu_id'];
            $userMenu->can_view = $permission['can_view'];
            $userMenu->can_add = $permission['can_add'];
            $userMenu->can_edit = $permission['can_edit'];
            $userMenu->can_delete = $permission['can_delete'];
            $userMenu->save();
        }

        return response()->json(['kode' => 1, 'message' => 'Hak akses menu berhasil disimpan!']);
    }

    public function getUserMenu(Request $request)
    {
        $user_id = $request->get('user_id');
        $data = UserMenu::where('user_id', $user_id)->get();
        return response()->json($data);
    }
} 