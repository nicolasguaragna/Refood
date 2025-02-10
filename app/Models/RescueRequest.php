<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RescueRequest extends Model
{
    use HasFactory;

    protected $table = 'rescue_requests';

    protected $fillable = [
        'user_id',
        'name',
        'contact',
        'location',
        'details',
        'service_id',
        'rescue_date',
        'latitude',
        'longitude'
    ];

    /**
     * Cast attributes to specific types.
     *
     * This ensures that rescue_date is always treated as a datetime object.
     */
    protected $casts = [
        'rescue_date' => 'datetime',
    ];

    /**
     * Define the relationship with the User model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Define the relationship with the Service model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }
}
