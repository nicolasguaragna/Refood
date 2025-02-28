<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;

    /**
     * Especifico el nombre de la tabla en la base de datos.
     *
     * @var string
     */
    protected $table = 'roles';

    /**
     * Defino los atributos que pueden ser asignados masivamente.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name'];

    /**
     * Relación de muchos a muchos con el modelo User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'rol_user');
    }
}
