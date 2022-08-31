<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //create a relationship with workouts to show that a users has many workouts
    public function workouts(){
        return $this->hasMany("App\Models\Workout");
    }

    //create a relationship with history to show that a users has many history records
    public function histories(){
        return $this->hasMany("App\Models\History");
    }

    //create a relationship with weights to show that a users has many weight records
    public function weights(){
        return $this->hasMany("App\Models\weight");
    }

    //create a relationship with bodymetrics to show that a users has many bodymetric records
    public function bodyMetrics(){
        return $this->hasMany("App\Models\BodyMetric");
    }
}
