<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    /**
     * Especifico la clave primaria de la tabla.
     *
     * @var string
     */
    protected $primaryKey = "service_id";

    /**
     * Indico si la clave primaria es autoincremental.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * Defino el tipo de la clave primaria.
     *
     * @var string
     */
    protected $keyType = 'int';
}
