<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        User::updateOrCreate(
            [ 'email' => 'admin@example.com' ],
            [
                'name' => 'Admin',
                'password' => bcrypt('admin123'),
                'kec_id' => null,
                'kel_id' => null,
                'rw_id' => null,
                'rt_id' => null,
                'is_active' => 1
            ]
        );
    }
} 