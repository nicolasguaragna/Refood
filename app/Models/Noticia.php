<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Noticia extends Model
{
    protected $table = 'noticias';
    // Campos permitidos para asignación masiva
    protected $fillable = [
        'titulo',
        'contenido',
        'imagen',
    ];

    /**
     * Accesor para obtener la URL completa de la imagen.
     *
     * Si no hay imagen, devuelve un placeholder predeterminado.
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
