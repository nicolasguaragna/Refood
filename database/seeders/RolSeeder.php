<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Rol;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Verifica si ya existe un rol antes de insertarlo
        Rol::firstOrCreate(['name' => 'admin']);
        Rol::firstOrCreate(['name' => 'user']);
    }
}
