<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Noticia extends Model
{
    /**
     * Especifico el nombre de la tabla en la base de datos.
     *
     * @var string
     */
    protected $table = 'noticias';

    /**
     * Defino los atributos que pueden ser asignados masivamente.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'titulo',
        'contenido',
        'imagen',
    ];

    /**
     * Obtengo la URL completa de la imagen de la noticia.
     *
     * @return string
     */
    public function getImagenUrlAttribute()
    {
        if ($this->imagen) {
            return asset('storage/' . $this->imagen);
        }

        // Imagen por defecto si no se ha cargado ninguna
        return asset('images/placeholder-news.jpg');
    }
}
