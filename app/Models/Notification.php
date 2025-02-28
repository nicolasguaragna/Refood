<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class Notification extends Model
{
    use Notifiable;

    /**
     * Indico que la clave primaria no es autoincremental.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * Defino el tipo de la clave primaria.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Evento de creación del modelo: asigna un UUID automáticamente.
     */
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->id = Str::uuid()->toString();
        });
    }
}
