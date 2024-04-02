<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['product', 'name','quant','price','tracking','code','holder','comments','option','delivery','shop','pickup','signature'];
    protected $casts = [
        'pickup' => 'boolean', 
        'signature' => 'boolean',
    ];

    public function drop()
    {
        return $this->belongsTo(Drop::class, 'id_drop');
    }
}
