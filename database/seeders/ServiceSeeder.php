<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('services')->insert([
            [
                'name' => 'Rescate S',
                'description' => 'Rescate auto-gestionado',
                'type' => 'S',
                'price' => 20000, // Precio para Rescate S
                'minimum_kg' => 10,
                'logistics_required' => 'No',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Rescate B',
                'description' => 'Rescate con más de 20kg',
                'type' => 'B',
                'price' => 35000, // Precio para Rescate B
                'minimum_kg' => 20,
                'logistics_required' => 'Sí',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Rescate C',
                'description' => 'Rescate de empresas con calendario fijo',
                'type' => 'C',
                'price' => 50000, // Precio para Rescate C
                'minimum_kg' => 50,
                'logistics_required' => 'Sí',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Rescate D',
                'description' => 'Rescate mayor a 1000kg',
                'type' => 'D',
                'price' => 60000, // Precio para Rescate D
                'minimum_kg' => 1000,
                'logistics_required' => 'Sí',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Receptores',
                'description' => 'Programa de apoyo a receptores',
                'type' => 'Receptores',
                'price' => 30000, // Precio para Receptores
                'minimum_kg' => null,
                'logistics_required' => 'No',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
