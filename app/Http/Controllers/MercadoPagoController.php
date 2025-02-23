<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\MercadoPagoConfig;
use App\Models\RescueRequest;
use Illuminate\Support\Facades\Auth;

class MercadoPagoController extends Controller
{
    /**
     * Configuro MP con el Access Token. 
     * Creo una preferencia de pago con un monto base de $1000.
     * 
     * Defino las URLs de retorno tras el pago.
     * Devuelvo la vista donate.blade.php con la clave pública y la ID de la preferencia.
     */
    public function showDonationForm()
    {
        MercadoPagoConfig::setAccessToken(env('MERCADO_PAGO_ACCESS_TOKEN'));

        $client = new PreferenceClient();
        $preference = $client->create([
            "items" => [
                [
                    "title" => "Donación a Refood",
                    "quantity" => 1,
                    "unit_price" => 1000, // Monto base por defecto
                ]
            ],
            "back_urls" => [
                "success" => route('donate.success'),
                "failure" => route('donate.failure'),
                "pending" => route('donate.pending'),
            ],
            "auto_return" => "approved",
        ]);

        if (!isset($preference->id)) {
            return redirect()->route('donate.form')->with('error', "No se pudo generar la preferencia de pago.");
        }

        return view('donate', [
            'preferenceId' => $preference->id,
            'publicKey' => env('MERCADO_PAGO_PUBLIC_KEY')
        ]);
    }


    /**
     * Procesar la donación con Mercado Pago.
     */
    public function processDonation(Request $request)
    {
        // Validar que la donación sea al menos $1000
        $request->validate([
            'amount' => 'required|numeric|min:1000',
        ]);

        MercadoPagoConfig::setAccessToken(env('MERCADO_PAGO_ACCESS_TOKEN'));

        $client = new PreferenceClient();
        $preference = $client->create([
            "items" => [
                [
                    "title" => "Donación a Refood",
                    "quantity" => 1,
                    "unit_price" => (float) $request->amount,
                ]
            ],
            "back_urls" => [
                "success" => route('donate.success'),
                "failure" => route('donate.failure'),
                "pending" => route('donate.pending'),
            ],
            "auto_return" => "approved",
        ]);

        if (!isset($preference->id)) {
            return redirect()->route('donate.form')->with('error', "No se pudo procesar la donación.");
        }

        return view('donate', [
            'preferenceId' => $preference->id,
            'publicKey' => env('MERCADO_PAGO_PUBLIC_KEY'),
            'amount' => $request->amount
        ]);
    }

    /**
     * Creo una preferencia de pago con el precio del servicio.
     * Busco el servicio de rescate en la base de datos.
     * Configuro las URL de retorno tras el pago.
     * Devuelvo a la vista servicios.pay.blade.php con la clave pública y el ID de pago.
     */
    public function payService($serviceId)
    {
        try {
            MercadoPagoConfig::setAccessToken(env('MERCADO_PAGO_ACCESS_TOKEN'));

            $service = RescueRequest::findOrFail($serviceId);

            $client = new PreferenceClient();
            $preference = $client->create([
                "items" => [
                    [
                        "title" => "Pago por servicio de rescate",
                        "quantity" => 1,
                        "unit_price" => (float) $service->service->price, // Convertir a float por seguridad
                        "currency_id" => "ARS", // Asegurar que la moneda sea pesos argentinos
                    ]
                ],
                "payer" => [
                    "email" => auth()->user()->email ?? "comprador@email.com" // Email del comprador
                ],
                "back_urls" => [
                    "success" => route('services.payment.success', $service->id),
                    "failure" => route('services.payment.failure', $service->id),
                    "pending" => route('services.payment.pending', $service->id),
                ],
                "auto_return" => "approved",
            ]);

            if (!isset($preference->id)) {
                \Log::error('Mercado Pago: No se pudo generar la preferencia de pago. Respuesta API: ', (array) $preference);
                return redirect()->route('user.services')->with('error', "No se pudo generar el pago.");
            }

            return view('servicios.pay', [
                'preferenceId' => $preference->id,
                'publicKey' => env('MERCADO_PAGO_PUBLIC_KEY'),
                'service' => $service
            ]);
        } catch (\Exception $e) {
            \Log::error('Error en Mercado Pago: ' . $e->getMessage());
            return redirect()->route('user.services')->with('error', "Error al procesar el pago. Contacta al soporte.");
        }
    }


    /**
     * registro en logs que el pago fue recibido.
     * Busco el servicio en la base de datos.
     * Actualizo el estado a "Pagado" (is_paid = true).
     * Reautentico al usuario si se deslogueó.
     * Redirijo a user.services con un mensaje de éxito.
     */
    public function paymentSuccess(Request $request, $serviceId)
    {
        \Log::info("Pago recibido para el servicio ID: " . $serviceId);
        \Log::info("Datos recibidos de MercadoPago:", $request->all());

        $service = RescueRequest::find($serviceId);
        if (!$service) {
            \Log::error("❌ Servicio no encontrado - ID: " . $serviceId);
            return redirect()->route('user.services')->with('error', 'Servicio no encontrado.');
        }

        if (!$service->is_paid) {
            $service->is_paid = true;
            $service->save();
            \Log::info("✅ Estado de pago actualizado para servicio ID: " . $serviceId);
        } else {
            \Log::info("ℹ️ El servicio ID: " . $serviceId . " ya estaba pagado.");
        }

        // Re-autenticar al usuario antes de la redirección
        if (!Auth::check()) {
            $user = RescueRequest::find($serviceId)->user; // Obtener usuario del servicio pagado
            Auth::login($user);
            \Log::info("Usuario re-autenticado tras el pago: " . $user->id);
        }

        return redirect()->route('user.services')->with('success', 'El pago se realizó con éxito.');
    }

    /**
     * Manejar un pago fallido.Si el pago falla, redirijo a Mis Servicios con un mensaje de error.
     */
    public function paymentFailure($serviceId)
    {
        return redirect()->route('user.services')->with('error', 'Hubo un problema con el pago.');
    }

    /**
     * Si el pago queda en estado "pendiente", notifico al usuario y lo redirijo a Mis Servicios.
     */
    public function paymentPending($serviceId)
    {
        return redirect()->route('user.services')->with('info', 'El pago está pendiente de confirmación.');
    }
}
