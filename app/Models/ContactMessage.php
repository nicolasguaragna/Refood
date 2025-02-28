<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    use HasFactory;
    /**
     * Defino los atributos que pueden ser asignados masivamente.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nombre',  // Nombre del remitente del mensaje
        'email',   // Correo electrónico del remitente
        'mensaje', // Contenido del mensaje enviado
    ];
}
