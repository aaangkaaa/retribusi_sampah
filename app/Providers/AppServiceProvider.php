<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use App\Models\Menu;
use Illuminate\Support\Facades\Log;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Passport::ignoreRoutes();
        View::composer('*', function ($view) {
            $user = auth()->user();
            
            if ($user && $user->role_id) {
                // Ambil menu yang diizinkan
                $menus = \App\Models\Menu::join('role_menu', 'menu.id', '=', 'role_menu.menu_id')
                    ->where('role_menu.role_id', $user->role_id)
                    ->where('role_menu.can_view', 1)
                    ->where('menu.is_active', 1)
                    ->orderBy('menu.urutan')
                    ->select('menu.*')
                    ->get();

                // Debug: Cek hasil join
                Log::info('Joined menu data:', ['menus' => $menus->toArray()]);

                // Fungsi rekursif sebagai closure agar tidak error redeclare
                $buildMenuTree = function($menus, $parentId = null) use (&$buildMenuTree) {
                    $branch = [];
                    foreach ($menus as $menu) {
                        if ($menu->parent_id === $parentId) {
                            $children = $buildMenuTree($menus, $menu->id);
                            $menu->children = $children->count() ? $children : collect();
                            $branch[] = $menu;
                        }
                    }
                    return collect($branch);
                };
                $menuTree = $buildMenuTree($menus, null);

                // Debug: Cek struktur menu akhir
                Log::info('Final menu structure:', ['parents' => $menuTree]);

                $view->with('menuTree', $menuTree);
            } else {
                Log::info('No user or role_id found');
                $view->with('menuTree', collect());
            }
        });
    }
}
