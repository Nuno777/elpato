<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'name',
        'id_drop',
        'product',
        'quant',
        'price',
        'tracking',
        'code',
        'holder',
        'comments',
        'options',
        'delivery_date',
        'shop',
        'need_pickup',
        'signature_required',
    ];

    protected $casts = [
        'delivery_date' => 'date',
        'need_pickup' => 'boolean',
        'signature_required' => 'boolean',
    ];

    public function drop()
    {
        return $this->belongsTo(Drop::class, 'id_drop');
    }
}
