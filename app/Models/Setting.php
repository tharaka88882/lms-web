<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'commission',
        'payout_limit',
        'streaming_amount',
        'paid_level'
    ];

}
