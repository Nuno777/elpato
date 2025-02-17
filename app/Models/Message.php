<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $primaryKey = 'uuid';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['uuid','drop_id', 'user_id', 'message', 'response'];

    public function drop()
    {
        return $this->belongsTo(Drop::class,'drop_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
