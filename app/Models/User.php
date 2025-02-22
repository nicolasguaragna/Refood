<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Define la relación de muchos a muchos con el modelo Rol.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Rol::class, 'rol_user');
    }

    // Método para verificar si el usuario tiene un rol específico
    public function hasRole($roleName)
    {
        return $this->roles()->where('name', $roleName)->exists();
    }

    // Relación con las solicitudes de rescate
    public function rescueRequests()
    {
        return $this->hasMany(RescueRequest::class, 'user_id');
    }

    /**
     * Obtener el número de contacto del usuario.
     * Si el usuario no tiene un número en `users`, se toma el más reciente de `rescue_requests`.
     *
     * @return string|null
     */
    public function getContactAttribute()
    {
        return optional($this->rescueRequests()->latest()->first())->contact;
    }
}
