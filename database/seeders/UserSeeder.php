<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash; // Para usar bcrypt en la contraseña

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password'), // Encriptar la contraseña
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
