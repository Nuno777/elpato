<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $primaryKey = 'uuid';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'uuid',
        'slug',
        'name',
        'email',
        'password',
        'email_verified_at',
        'type',
        'telegram',
        'profile_image',
        'blocked'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function ftid()
    {
        return $this->hasMany(Ftid::class);
    }

    public function drops()
    {
        return $this->belongsToMany(Drop::class, 'user_drop', 'user_id', 'drop_id')->withTimestamps();
    }

    public function messages()
    {
        return $this->hasMany(Message::class, 'user_id');
    }

    public function preferences()
    {
        return $this->hasMany(UserDropPreference::class, 'username', 'telegram');
    }
}
