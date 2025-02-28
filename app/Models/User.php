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
     * Los atributos que pueden ser asignados masivamente.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
    ];

    /**
     * Los atributos que deben estar ocultos para la serialización.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Defino los atributos que deben ser casteados a tipos específicos.
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
     * Relación de muchos a muchos con el modelo Rol.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Rol::class, 'rol_user');
    }

    /**
     * Verifico si el usuario tiene un rol específico.
     *
     * @param string $roleName
     * @return bool
     */
    public function hasRole($roleName)
    {
        return $this->roles()->where('name', $roleName)->exists();
    }

    /**
     * Relación uno a muchos con las solicitudes de rescate.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rescueRequests()
    {
        return $this->hasMany(RescueRequest::class, 'user_id');
    }

    /**
     * Obtengo el número de contacto del usuario.
     * Si el usuario no tiene un número en `users`, se toma el más reciente de `rescue_requests`.
     *
     * @return string|null
     */
    public function getContactAttribute()
    {
        return optional($this->rescueRequests()->latest()->first())->contact;
    }
}
