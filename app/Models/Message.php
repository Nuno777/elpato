<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = ['drop_id', 'user_id', 'message', 'response'];

    public function drop()
    {
        return $this->belongsTo(Drop::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
