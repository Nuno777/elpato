<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDrop extends Model
{
    use HasFactory;

    protected $table = 'user_drop';

    protected $fillable = ['user_id', 'drop_id'];
}
