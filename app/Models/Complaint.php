<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    protected $fillable = [
        'mentor_id',
        'user_id',
        'description',
        'seen'
    ];


    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id','users');
    }
    public function mentor(){
        return $this->belongsTo(Teacher::class, 'mentor_id', 'id','teachers');
    }
}
