<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = [
        'name',
        'status'
    ];

    public function teachersubject()
    {
        return $this->hasMany(TeacherSubject::class, 'teacher_id', 'id');
    }
}
