<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@correo.com',
            'password' => Hash::make('password'),
            'phone' => '3271094465',
            'permissions' => 'admin',
        ]);

        User::create([
            'name' => 'usuario',
            'email' => 'usuario@correo.com',
            'password' => Hash::make('password'),
            'phone' => '1234567890',
            'permissions' => 'user',
        ]);
    }
}
