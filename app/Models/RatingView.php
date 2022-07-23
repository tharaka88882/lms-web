<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RatingView extends Model
{
    protected $fillable = [
        'r_count',
        'status'
    ];

    public function mentor(){
        return $this->belongsTo(Teacher::class,'mentor_id','id','teachers');
    }
}
