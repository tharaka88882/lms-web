<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Qualification extends Model
{
    protected $fillable = [
        'text',
        'field',
        'location',
        'start_date',
        'end_date',
        'grade'

    ];

    public function mentor(){
        return $this->belongsTo(Teacher::class,'teacher_id','id','teachers');
    }
    public function institute(){
        return $this->belongsTo(Institute::class,'institute_id','id','institutes');
    }
}
