<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTransaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'sender_id',
        'receiver_id',
        'amount',
        'notes',
        'status'
    ];

    public function sender(){
        return $this->belongsTo(User::class,'sender_id','id','users');
    }
    public function receiver(){
        return $this->belongsTo(User::class,'receiver_id','id','users');
    }

}
