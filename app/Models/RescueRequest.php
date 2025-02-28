<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RescueRequest extends Model
{
    use HasFactory;

    /**
     * Defino la tabla asociada al modelo.
     * 
     * @var string
     */
    protected $table = 'rescue_requests';

    /**
     * Especifico los campos que pueden ser asignados masivamente.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'name',
        'contact',
        'location',
        'details',
        'service_id',
        'rescue_date',
        'latitude',
        'longitude',
        'is_paid',
        'status',
        'food_type'
    ];


    /**
     * Defino los atributos que deben ser convertidos a tipos específicos.
     *
     * @var array
     */
    protected $casts = [
        'rescue_date' => 'datetime',
    ];

    /**
     * Relación con el modelo User (Usuario que creó la solicitud de rescate).
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relación con el modelo Service (Servicio asociado a la solicitud de rescate).
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    /**
     * Determino la prioridad de la solicitud en función de las palabras clave en los detalles.
     *
     * @return string
     */
    public function getPriorityAttribute()
    {
        $highPriorityKeywords = ['carne', 'lácteo', 'tomate', 'lechuga', 'banana', 'frutilla', 'palta', 'espinaca', 'uva', 'embutidos', 'verdura fresca', 'pollo', 'pescado', 'queso', 'huevo', 'alimentos cocidos', 'manteca'];
        $mediumPriorityKeywords = ['pan', 'harina', 'verdura no perecedera', 'fruta', 'leche en polvo', 'pasta', 'fideos', 'granos', 'tubérculo', 'galletas'];

        // Convierto a minúsculas para evitar problemas de mayúsculas/minúsculas
        $detailsLower = strtolower($this->details);

        // Verifico si alguna palabra clave está en los detalles
        foreach ($highPriorityKeywords as $word) {
            if (str_contains($detailsLower, $word)) {
                return 'Alta';
            }
        }

        foreach ($mediumPriorityKeywords as $word) {
            if (str_contains($detailsLower, $word)) {
                return 'Media';
            }
        }

        return 'Baja';
    }
}
