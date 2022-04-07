<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Notifications\UserResetPasswordNotification;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'role_id',
        'given_name',
        'last_name',
        'phone_no',
        'city',
        'province',
        'email',
        'username',
        'image',
        'about',
        'password',
        'status',
        'trial_until'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $dates = [
        'trial_until'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function agent_verification()
    {
        return $this->hasOne(AgentVerification::class, 'agent_id');
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new UserResetPasswordNotification($token));
    }

    public function getFreeTrialDaysLeftAttribute()
    {
        // Future field that will be implemented after payments
        if ($this->plan_until) { 
            return 0;
        }

        return now()->diffInDays($this->trial_until, false);
    }

    public function ch_message()
    {
        return $this->hasMany(ChMessage::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function properties()
    {
        return $this->hasMany(Property::class);
    }
}
