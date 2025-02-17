<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDropPreference extends Model
{
    use HasFactory;

    protected $primaryKey = 'uuid';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $table = 'user_drop_preferences';
    protected $fillable = ['uuid','chat_id', 'drop_ids','username','telegram'];

    public function user()
    {
        return $this->belongsTo(User::class, 'username', 'telegram');
    }
}
