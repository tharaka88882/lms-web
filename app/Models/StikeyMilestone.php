<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StikeyMilestone extends Model
{
    protected $fillable = [
        's_note',
        'user_id',
        'milestone_id'
    ];

    public function mentor(){
        return $this->belongsTo(Milestone::class,'milestone_id','id','milestones');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id','id','users');
    }
}
