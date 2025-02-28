<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonationSponsorship extends Model
{
    use HasFactory;


    /**
     * Especifico el nombre de la tabla en la base de datos.
     *
     * @var string
     */
    protected $table = 'donations_sponsorships';

    /**
     * Defino los atributos que pueden ser asignados masivamente.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'donor_name',        // Nombre del donante
        'amount',            // Monto donado o patrocinado
        'payment_method',    // Método de pago utilizado
        'transaction_id',    // ID de la transacción de pago
        'type',              // Tipo de transacción (donación o patrocinio)
    ];
}
