<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RescueRequest extends Model
{
    use HasFactory;

    protected $table = 'rescue_requests';

    protected $fillable = [
        'user_id', 'name', 'contact', 'location', 'details', 'service_id'
    ];

    // Relación con el usuario
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relación con el servicio
    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }
}
