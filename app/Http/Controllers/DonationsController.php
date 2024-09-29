<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DonationsController extends Controller
{
    // Función para listar todas las donaciones
    public function index()
    {
        $donations = Donation::all();
        return view('donations.index', compact('donations'));
    }

    // Función para mostrar el formulario de donación
    public function create()
    {
        return view('donations.create');
    }

    // Función para almacenar una nueva donación
    public function store(Request $request)
    {
        $request->validate([
            'donor_name' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'payment_method' => 'required|string',
        ]);

        Donation::create([
            'donor_name' => $request->donor_name,
            'amount' => $request->amount,
            'payment_method' => $request->payment_method,
            'transaction_id' => $request->transaction_id,
        ]);

        return redirect()->route('donations.index')->with('success', 'Donación registrada con éxito');
    }

    // Función para mostrar los detalles de una donación
    public function show($id)
    {
        $donation = Donation::findOrFail($id);
        return view('donations.show', compact('donation'));
    }

    // Función para eliminar una donación
    public function destroy($id)
    {
        $donation = Donation::findOrFail($id);
        $donation->delete();
        return redirect()->route('donations.index')->with('success', 'Donación eliminada con éxito');
    }
}
