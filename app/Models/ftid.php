<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ftid extends Model
{
    use HasFactory;

    protected $fillable = ['user', 'carrier', 'tracking', 'store', 'label', 'status', 'method', 'comments', 'label_creation_date', 'label_payment_date'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
