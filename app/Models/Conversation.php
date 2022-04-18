<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    protected $fillable = [
        'teacher_id',
        'student_id',
        'subject_id',
        'status'
    ];

    public function messages(){
        return $this->hasMany(Message::class, 'conversation_id', 'id');
    }

    public function teacher(){
        return $this->belongsTo(Teacher::class, 'teacher_id', 'id', 'teachers');
    }

    public function student(){
        return $this->belongsTo(Student::class, 'student_id', 'id', 'students');
    }
}
