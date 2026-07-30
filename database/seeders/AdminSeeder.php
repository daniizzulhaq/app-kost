<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin Kost',
            'email' => 'admin@kost.test',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);
    }
}