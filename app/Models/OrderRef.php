<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderRef extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id','user', 'product', 'quant', 'price', 'tracking', 'code', 'comments', 'shop', 'status', 'slug'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
