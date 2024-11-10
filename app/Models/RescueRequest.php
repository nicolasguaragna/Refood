<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RescueRequest extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'name', 'contact', 'location', 'details'];

    // Relación con el usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
