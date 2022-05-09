<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'oauth_id',
        'oauth_type',
        'streaming_count',
        'image',
        'address',
        'city',
        'streaming_count'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
        'address',
        'city',
        'country',
        'cover_image',
        'company',
        'social_id'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function userable()
    {
        return $this->morphTo();
    }
    public function complaint()
    {
        return $this->hashMany(Complaint::class, 'user_id','id');
    }
    public function user_transaction(){
        return $this->hasMany(UserTransaction::class);
    }

    public function milestones(){
        return $this->hasMany(Milestone::class);
    }
    public function rates(){
        return $this->hasMany(Rating::class);
    }
    public function stikey(){
        return $this->hasMany(StikeyNote::class);
    }
    public function stikeymentee(){
        return $this->hasMany(StikeyNoteMentee::class);
    }


}
