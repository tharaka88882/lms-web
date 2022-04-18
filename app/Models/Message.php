<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'message',
        'sender_id',
        'conversation_id'
    ];

    public function conversation(){
        return $this->belongsTo(Conversation::class, 'conversation_id', 'id', 'conversations');
    }

    public function sender(){
        return $this->belongsTo(User::class, 'sender_id', 'id', 'users');
    }
}
