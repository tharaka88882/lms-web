<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MentorConversation extends Model
{
    protected $fillable = [
        'mentor_id',
        'mentee_id',
        'subject_id',
        'status'
    ];


    public function messages(){
        return $this->hasMany(MentorMessage::class, 'conversation_id', 'id');
    }

    public function mentor(){
        return $this->belongsTo(Teacher::class, 'mentor_id', 'id', 'teachers');
    }
    public function mentee(){
        return $this->belongsTo(Teacher::class, 'mentee_id', 'id', 'teachers');
    }
}
