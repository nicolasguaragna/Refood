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
                'email' => 'micag@example.com',
                'password' => Hash::make('1234'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Tatiana Barrios',
                'email' => 'tatianab@example.com',
                'password' => Hash::make('1234'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Brian Guaragna',
                'email' => 'briang@example.com',
                'password' => Hash::make('1234'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Nico Guaragna',
                'email' => 'nico_guaragna@hotmail.com',
                'password' => Hash::make('1234'), 
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
