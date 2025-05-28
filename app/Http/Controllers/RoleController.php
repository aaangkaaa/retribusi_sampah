<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Menu;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    public function index()
    {
        return view('master-role');
    }

    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $data = Role::select('roles.*');
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
            $role = new Role();
            $role->nama = $request->nama;
            $role->keterangan = $request->keterangan;
            $role->is_active = $request->is_active;
            if($role->save()) {
                // Simpan hak akses menu jika ada
                if($request->has('menu_permissions')) {
                    $this->saveRoleMenuInternal($role->id, $request->menu_permissions);
                }
                return response()->json(['kode' => 1, 'message' => 'Data role & hak akses berhasil disimpan!', 'id' => $role->id]);
            }
            return response()->json(['kode' => 0, 'message' => 'Data role gagal disimpan!']);
        } else {
            $role = Role::find($request->id);
            $role->nama = $request->nama;
            $role->keterangan = $request->keterangan;
            $role->is_active = $request->is_active;
            if($role->save()) {
                // Simpan hak akses menu jika ada
                if($request->has('menu_permissions')) {
                    $this->saveRoleMenuInternal($role->id, $request->menu_permissions);
                }
                return response()->json(['kode' => 1, 'message' => 'Data role & hak akses berhasil diupdate!', 'id' => $role->id]);
            }
            return response()->json(['kode' => 0, 'message' => 'Data role gagal diupdate!']);
        }
    }

    // Tambahkan fungsi internal untuk simpan role menu
    private function saveRoleMenuInternal($role_id, $menu_permissions)
    {
        \DB::table('role_menu')->where('role_id', $role_id)->delete();
        
        // Get all menus to find parent-child relationships
        $allMenus = Menu::all();
        $menuMap = $allMenus->keyBy('id');
        
        // First pass: Collect all menu IDs that need to be activated
        $menusToActivate = collect();
        foreach($menu_permissions as $permission) {
            if($permission['can_view'] || $permission['can_add'] || $permission['can_edit'] || $permission['can_delete']) {
                $menusToActivate->push($permission['menu_id']);
                
                // Add all parent menus
                $currentMenu = $menuMap[$permission['menu_id']] ?? null;
                while($currentMenu && $currentMenu->parent_id) {
                    $menusToActivate->push($currentMenu->parent_id);
                    $currentMenu = $menuMap[$currentMenu->parent_id] ?? null;
                }
            }
        }
        
        // Second pass: Save all permissions, including parent menus
        foreach($menu_permissions as $permission) {
            \DB::table('role_menu')->insert([
                'role_id' => $role_id,
                'menu_id' => $permission['menu_id'],
                'can_view' => $permission['can_view'],
                'can_add' => $permission['can_add'],
                'can_edit' => $permission['can_edit'],
                'can_delete' => $permission['can_delete'],
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
        
        // Add parent menus that weren't in the original permissions
        foreach($menusToActivate->unique() as $menuId) {
            if(!collect($menu_permissions)->contains('menu_id', $menuId)) {
                \DB::table('role_menu')->insert([
                    'role_id' => $role_id,
                    'menu_id' => $menuId,
                    'can_view' => 1,
                    'can_add' => 0,
                    'can_edit' => 0,
                    'can_delete' => 0,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }
    }

    public function getDataById(Request $request)
    {
        $id = $request->get('id');
        $data = Role::find($id);
        return response()->json($data);
    }

    public function delete(Request $request)
    {
        $id = $request->get('id');
        $role = Role::find($id);
        // Hapus data hak akses role di tabel role_menu
        DB::table('role_menu')->where('role_id', $id)->delete();
        if($role->delete()) {
            return response()->json(['kode' => 1, 'message' => 'Data role berhasil dihapus!']);
        }
        return response()->json(['kode' => 0, 'message' => 'Data role gagal dihapus!']);
    }

    public function getMenu()
    {
        $menus = Menu::whereNull('parent_id')->orderBy('urutan')->get();
        foreach ($menus as $parent) {
            $parent->children = Menu::where('parent_id', $parent->id)->orderBy('urutan')->get();
            foreach ($parent->children as $child) {
                $child->children = Menu::where('parent_id', $child->id)->orderBy('urutan')->get();
            }
        }
        return response()->json($menus);
    }

    public function getRoleMenu(Request $request)
    {
        $role_id = $request->get('role_id');
        $data = DB::table('role_menu')->where('role_id', $role_id)->get();
        return response()->json($data);
    }
} 