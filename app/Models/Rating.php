<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable = [
        'rating',
        'description',
        'answer'
    ];

    public function rator(){
        return $this->belongsTo(User::class,'user_id','id','users');
    }
    public function ratee(){
        return $this->belongsTo(Teacher::class,'teacher_id','id','teachers');
    }
}
