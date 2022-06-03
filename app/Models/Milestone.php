<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Milestone extends Model
{
    protected $fillable = [
        'note',
        'stikey',
        'status',
        'due_date',
        'user_id'
    ];

    public function notes(){
        return $this->hasMany(Note::class);
    }

    public function m_stikey(){
        return $this->hasMany(StikeyMilestone::class);
    }
}
