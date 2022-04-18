<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserOrder extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id',
        'amount',
        'payment_package_id',
        'reference',
        'status',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id', 'users');
    }

    public function payment_package(){
        return $this->belongsTo(PaymentPackage::class, 'payment_package_id', 'id', 'payment_packages');
    }
}
