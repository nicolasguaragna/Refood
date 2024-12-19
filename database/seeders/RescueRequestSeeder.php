<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\RescueRequest;
use App\Models\Service;

class RescueRequestSeeder extends Seeder
{
    public function run()
    {
        // Crear un usuario de prueba
        $user = User::firstOrCreate([
            'name' => 'Brian Guaragna',
            'email' => 'briang@example.com',
            'password' => bcrypt('password123'),
        ]);

        // Crear un servicio de prueba
        $service = Service::firstOrCreate([
            'name' => 'Rescate B',
            'price' => 35000,
            'description' => 'Rescate con más de 20kg',
        ]);

        // Crear una solicitud de rescate para ese usuario y servicio
        RescueRequest::create([
            'user_id' => $user->id,
            'service_id' => $service->id,
            'contact' => '123456789',
            'location' => 'Buenos Aires',
            'details' => 'Rescate urgente',
            'rescue_date' => now(),
        ]);
    }
}
