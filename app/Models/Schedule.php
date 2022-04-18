<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'name',
        'description',
        'schedule_date',
        'start_time',
        'end_time',
        'status'
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}
