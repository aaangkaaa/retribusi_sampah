<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    public function run()
    {
        // Menu Master
        DB::table('menu')->insert([
            'nama' => 'Menu Master',
            'icon' => 'fa fa-database',
            'url' => '#',
            'parent_id' => null,
            'urutan' => 1,
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $menuMasterId = DB::getPdo()->lastInsertId();

        // Sub Menu Master
        DB::table('menu')->insert([
            [
                'nama' => 'Master Kecamatan',
                'icon' => 'fa fa-map-marker',
                'url' => 'master-kecamatan',
                'parent_id' => $menuMasterId,
                'urutan' => 1,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Master Kelurahan',
                'icon' => 'fa fa-building',
                'url' => 'master-kelurahan',
                'parent_id' => $menuMasterId,
                'urutan' => 2,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Master RW',
                'icon' => 'fa fa-users',
                'url' => 'master-rw',
                'parent_id' => $menuMasterId,
                'urutan' => 3,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Master RT',
                'icon' => 'fa fa-user-friends',
                'url' => 'master-rt',
                'parent_id' => $menuMasterId,
                'urutan' => 4,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Master Tarif',
                'icon' => 'fa fa-money-bill',
                'url' => 'master-tarif',
                'parent_id' => $menuMasterId,
                'urutan' => 5,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Master WR',
                'icon' => 'fa fa-user',
                'url' => 'master-wr',
                'parent_id' => $menuMasterId,
                'urutan' => 6,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Master User',
                'icon' => 'fa fa-users-cog',
                'url' => 'master-user',
                'parent_id' => $menuMasterId,
                'urutan' => 7,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Role Akses',
                'icon' => 'fa fa-key',
                'url' => 'master-role',
                'parent_id' => $menuMasterId,
                'urutan' => 8,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Master Menu',
                'icon' => 'fa fa-list',
                'url' => 'master-menu',
                'parent_id' => $menuMasterId,
                'urutan' => 9,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

        // Menu Transaksi
        DB::table('menu')->insert([
            'nama' => 'Menu Transaksi',
            'icon' => 'fa fa-exchange-alt',
            'url' => '#',
            'parent_id' => null,
            'urutan' => 2,
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $menuTransaksiId = DB::getPdo()->lastInsertId();

        // Sub Menu Transaksi
        DB::table('menu')->insert([
            [
                'nama' => 'Penetapan WR',
                'icon' => 'fa fa-file-alt',
                'url' => 'penetapan-wr',
                'parent_id' => $menuTransaksiId,
                'urutan' => 1,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Pembayaran',
                'icon' => 'fa fa-money-bill-wave',
                'url' => 'pembayaran',
                'parent_id' => $menuTransaksiId,
                'urutan' => 2,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

        // Menu Laporan
        DB::table('menu')->insert([
            'nama' => 'Menu Laporan',
            'icon' => 'fa fa-chart-bar',
            'url' => '#',
            'parent_id' => null,
            'urutan' => 3,
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $menuLaporanId = DB::getPdo()->lastInsertId();

        // Sub Menu Laporan
        DB::table('menu')->insert([
            [
                'nama' => 'Laporan Penetapan',
                'icon' => 'fa fa-file-invoice',
                'url' => 'laporan-penetapan',
                'parent_id' => $menuLaporanId,
                'urutan' => 1,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Laporan Pembayaran',
                'icon' => 'fa fa-file-invoice-dollar',
                'url' => 'laporan-pembayaran',
                'parent_id' => $menuLaporanId,
                'urutan' => 2,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
} 