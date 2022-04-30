<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StikeyNote extends Model
{
    protected $fillable = [
        'note',
        'user_id',
        'teacher_id'
    ];

    public function mentor(){
        return $this->belongsTo(Teacher::class,'teacher_id','id','teachers');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id','id','users');
    }
}
