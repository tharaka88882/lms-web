<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentPackage extends Model
{
    protected $fillable = [
        'name',
        'steaming_count',
        'description',
        'price',
        'color',
        'status'
    ];
}
