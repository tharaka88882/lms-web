<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StikeyNoteMentee extends Model
{
    protected $fillable = [
        'note',
        'user_id',
        'student_id'
    ];

    public function mentee(){
        return $this->belongsTo(Student::class,'student_id','id','students');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id','id','users');
    }}
