<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\MercadoPagoConfig;

class MercadoPagoController extends Controller
{
    public function show()
    {
        // Configurar las credenciales de Mercado Pago desde .env
        MercadoPagoConfig::setAccessToken(env('MERCADO_PAGO_ACCESS_TOKEN'));

        // Crear una preferencia para la donación
        $client = new PreferenceClient();
        $preference = $client->create([
            "items" => [
                [
                    "title" => "Donación a Refood",
                    "quantity" => 1,
                    "unit_price" => 500, // Monto fijo de ejemplo
                ]
            ],
            "back_urls" => [
                "success" => route('donate.success'), // URL para pagos exitosos
                "failure" => route('donate.failure'), // URL para pagos fallidos
                "pending" => route('donate.pending'), // URL para pagos pendientes
            ],
            "auto_return" => "approved", // Retorno automático solo para pagos aprobados
        ]);

        // Verificar que la preferencia se creó correctamente
        if (!isset($preference->id)) {
            abort(500, "No se pudo generar la preferencia.");
        }

        // Pasar el ID de la preferencia y la clave pública a la vista
        return view('donate', [
            'preferenceId' => $preference->id, // Enviar solo el ID
            'publicKey' => env('MERCADO_PAGO_PUBLIC_KEY'), // Clave pública
        ]);
    }
}
