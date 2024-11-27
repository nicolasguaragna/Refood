<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonationSponsorship extends Model
{
    use HasFactory;

    protected $table = 'donations_sponsorships';

    protected $fillable = [
        'donor_name',
        'amount',
        'payment_method',
        'transaction_id',
        'type',
    ];
}
