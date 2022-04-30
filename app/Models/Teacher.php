<?php



namespace App\Models;



use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;



class Teacher extends Model

{

    protected $fillable = [

        'nic',

        'qualification',

        'experience',

        'skills',

        'industry',

        'job',

        'rating',

        'level',

        'linkedin_link'

    ];



    public function user()

    {

        return $this->morphOne(User::class, 'userable');

    }



    public function teachersubject()

    {

        return $this->hasMany(TeacherSubject::class, 'teacher_id', 'id');

    }



    public function shadules()

    {

        return $this->hasMany(Schedule::class);

    }

    public function complaint()

    {

        return $this->hashMany(Complaint::class, 'mentor_id','id');

    }

    public function ratings(){
        return $this->hasMany(Rating::class);
    }
    public function rate(){
        return $this->hasMany(Rating::class);
    }

     public function stikey(){
        return $this->hasMany(StikeyNote::class);
    }

}

