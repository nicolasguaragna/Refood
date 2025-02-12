<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\MercadoPagoConfig;
use App\Models\RescueRequest;

class MercadoPagoController extends Controller
{
    /**
     * Mostrar el formulario de donación donde el usuario puede elegir el monto.
     */
    public function showDonationForm()
    {
        return view('donate-form'); // Vista para elegir el monto de donación
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
     * Generar un pago para un servicio de rescate.
     */
    public function payService($serviceId)
    {
        MercadoPagoConfig::setAccessToken(env('MERCADO_PAGO_ACCESS_TOKEN'));

        $service = RescueRequest::findOrFail($serviceId);

        // ✅ Evitar pagos de servicios ya pagados
        if ($service->is_paid) {
            return redirect()->route('user.services')->with('error', 'Este servicio ya ha sido pagado.');
        }

        try {
            $client = new PreferenceClient();
            $preference = $client->create([
                "items" => [
                    [
                        "title" => "Pago por servicio de rescate",
                        "quantity" => 1,
                        "unit_price" => isset($service->service) ? $service->service->price : 0.00, // Evitar errores si no hay un servicio asignado
                    ]
                ],
                "back_urls" => [
                    "success" => route('services.payment.success', $service->id),
                    "failure" => route('services.payment.failure', $service->id),
                    "pending" => route('services.payment.pending', $service->id),
                ],
                "auto_return" => "approved",
            ]);

            if (!isset($preference->id)) {
                \Log::error("Mercado Pago: No se pudo generar la preferencia.", ['response' => $preference]);
                return redirect()->route('user.services')->with('error', "No se pudo generar el pago.");
            }

            return view('services.pay', [
                'preferenceId' => $preference->id,
                'publicKey' => env('MERCADO_PAGO_PUBLIC_KEY'),
                'service' => $service
            ]);
        } catch (\Exception $e) {
            \Log::error("Error en Mercado Pago: " . $e->getMessage());
            return redirect()->route('user.services')->with('error', "Error al procesar el pago. Contacta al soporte.");
        }
    }

    /**
     * Confirmar el pago exitoso y actualizar el estado del servicio.
     */
    public function paymentSuccess($serviceId)
    {
        $service = RescueRequest::findOrFail($serviceId);
        $service->update(['is_paid' => true]);

        return redirect()->route('user.services')->with('success', 'El pago se realizó con éxito.');
    }

    /**
     * Manejar un pago fallido.
     */
    public function paymentFailure($serviceId)
    {
        return redirect()->route('user.services')->with('error', 'Hubo un problema con el pago.');
    }

    /**
     * Manejar pagos pendientes.
     */
    public function paymentPending($serviceId)
    {
        return redirect()->route('user.services')->with('info', 'El pago está pendiente de confirmación.');
    }
}
