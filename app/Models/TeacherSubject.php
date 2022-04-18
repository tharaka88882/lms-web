<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherSubject extends Model
{

    protected $fillable = [
        'teacher_id',
        'subject_id'
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id', 'id', 'teachers');
    }
    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id', 'id', 'subjects');
    }
}
