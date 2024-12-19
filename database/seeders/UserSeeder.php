<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash; // Para usar bcrypt en la contraseña
use App\Models\User; // Asegúrate de importar el modelo User

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'micag@example.com'], // Condición para evitar duplicados
            [
                'name' => 'Micaela Guaragna',
                'password' => Hash::make('1234'), // Encripta la contraseña
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        User::firstOrCreate(
            ['email' => 'tatianab@example.com'],
            [
                'name' => 'Tatiana Barrios',
                'password' => Hash::make('1234'),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        User::firstOrCreate(
            ['email' => 'briang@example.com'],
            [
                'name' => 'Brian Guaragna',
                'password' => Hash::make('1234'),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        User::firstOrCreate(
            ['email' => 'nico_guaragna@hotmail.com'],
            [
                'name' => 'Nico Guaragna',
                'password' => Hash::make('1234'),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}
