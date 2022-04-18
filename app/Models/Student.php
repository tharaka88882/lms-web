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
    // public function complaint()
    // {
    //     return $this->hashMany(Complaint::class, 'mentee_id','id');
    // }
}
