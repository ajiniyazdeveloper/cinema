<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    
    public function run(): void
    {
        User::updateOrCreate(
    ['email' => 'admin@test.com'],
    [
        'name' => 'Admin',
        'password' => Hash::make('password'),
        'is_admin' => true, // 👈 MUHIM
    ]
);
    }
}
