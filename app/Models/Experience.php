<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $fillable = [
        'text',
        'location',
        'start_date',
        'end_date'

    ];

    public function mentor(){
        return $this->belongsTo(Teacher::class,'teacher_id','id','teachers');
    }
    public function institute(){
        return $this->belongsTo(Institute::class,'institute_id','id','institutes');
    }
}
