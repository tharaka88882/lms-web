<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Institute extends Model
{
    protected $fillable = [
        'text'

    ];

    public function experience(){
        return $this->hasMany(Experience::class);
    }
    public function qualification(){
        return $this->hasMany(Qualification::class);
    }
}
