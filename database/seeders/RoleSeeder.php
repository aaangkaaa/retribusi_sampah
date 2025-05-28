<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run()
    {
        Role::updateOrCreate(
            ['nama' => 'Admin'],
            [
                'keterangan' => 'Administrator',
                'is_active' => 1
            ]
        );
    }
} 