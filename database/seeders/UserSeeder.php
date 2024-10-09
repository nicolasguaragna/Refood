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
            [
                'name' => 'Micaela Guaragna',
                'email' => 'test2@example.com',
                'password' => Hash::make('password'), // Encriptar la contraseña
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Tatiana Barrios',
                'email' => 'test3@example.com',
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Brian Guaragna',
                'email' => 'test4@example.com',
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Nico Guaragna',
                'email' => 'nico_guaragna@hotmail.com',
                'password' => Hash::make('1234'), // Encriptar la contraseña
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
