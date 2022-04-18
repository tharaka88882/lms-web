<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MentorMessage extends Model
{
    protected $fillable = [
        'message',
        'sender_id',
        'conversation_id'
    ];

    public function conversation(){
        return $this->belongsTo(MentorConversation::class, 'conversation_id', 'id', 'mentor_conversations');
    }

    public function sender(){
        return $this->belongsTo(Teacher::class, 'sender_id', 'id', 'teachers');
    }
}
