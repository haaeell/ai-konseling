<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@aikonseling.test'],
            [
                'name' => 'Admin Konselor',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );
    }
}
