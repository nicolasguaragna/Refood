<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Service;
use App\Models\RescueRequest;

class AssignServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener usuarios por su correo electrónico
        $micaela = User::where('email', 'micag@example.com')->first();
        $tatiana = User::where('email', 'tatianab@example.com')->first();
        $brian = User::where('email', 'briang@example.com')->first();

        // Obtener servicios por su nombre
        $rescateS = Service::where('name', 'Rescate S')->first();
        $rescateB = Service::where('name', 'Rescate B')->first();

        // Crear registros en la tabla `rescue_requests` para asignar los servicios
        if ($micaela && $rescateS) {
            RescueRequest::create([
                'user_id' => $micaela->id,
                'service_id' => $rescateS->service_id,
                'name' => 'Micaela Guaragna',
                'contact' => '11-5555-5555',
                'location' => 'Av. San Juan 3500',
                'details' => 'Necesito que rescaten 5 kg de papa y 2 kg de tomate',
                'rescue_date' => now()->addDays(2),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        if ($tatiana && $rescateB) {
            RescueRequest::create([
                'user_id' => $tatiana->id,
                'service_id' => $rescateB->service_id,
                'name' => 'Tatiana Barrios',
                'contact' => '11-4444-4444',
                'location' => 'Av. Belgrano 2000',
                'details' => 'Necesito que rescaten 20 kg de papa y 5 kg de tomate',
                'rescue_date' => now()->addDays(3),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        if ($brian && $rescateS) {
            RescueRequest::create([
                'user_id' => $brian->id,
                'service_id' => $rescateS->service_id,
                'name' => 'Brian Guaragna',
                'contact' => '11-3333-3333',
                'location' => 'Av. Rivadavia 1000',
                'details' => 'Necesito que rescaten 10 kg de zanahorias y 15 kg de manzanas',
                'rescue_date' => now()->addDays(4),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
