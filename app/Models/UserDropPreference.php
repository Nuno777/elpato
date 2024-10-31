<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDropPreference extends Model
{
    use HasFactory;

    protected $table = 'user_drop_preferences';
    protected $fillable = ['chat_id', 'drop_ids'];
}
