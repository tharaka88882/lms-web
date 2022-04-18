<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Milestone extends Model
{
    protected $fillable = [
        'note',
        'due_date',
        'user_id'
    ];
}
