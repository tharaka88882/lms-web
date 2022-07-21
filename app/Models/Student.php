<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'grade',
    ];

    public function user()
    {
        return $this->morphOne(User::class, 'userable');
    }

    public function user1()
    {
        return $this->morphOne(User::class, 'userable');
    }
    // public function complaint()
    // {
    //     return $this->hashMany(Complaint::class, 'mentee_id','id');
    // }
    public function stikey(){
        return $this->hasMany(StikeyNoteMentee::class);
    }
    public function stikey_note(){
        return $this->hasMany(StikeyNoteMentee::class);
    }
}
