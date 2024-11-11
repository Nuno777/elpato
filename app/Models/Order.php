<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{

    use HasFactory, SoftDeletes;

    protected $fillable = ['id_drop', 'user', 'product', 'name', 'address', 'quant', 'price', 'tracking', 'code', 'holder', 'comments', 'personalnotes', 'option', 'delivery', 'shop', 'pickup', 'signature', 'status', 'slug'];
    protected $casts = [
        'pickup' => 'boolean',
        'signature' => 'boolean',
    ];

    public function drop()
    {
        return $this->belongsTo(Drop::class, 'id_drop');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
