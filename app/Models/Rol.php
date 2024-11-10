<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;

    // Especifica el nombre de la tabla en la base de datos
    protected $table = 'roles';

    // Especifica los atributos que se pueden asignar en masa
    protected $fillable = ['name'];

    // Relación con el modelo User (muchos a muchos)
    public function users()
    {
        return $this->belongsToMany(User::class, 'rol_user');
    }
}
