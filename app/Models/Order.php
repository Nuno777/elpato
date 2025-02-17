<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Crypt;

class Order extends Model
{

    use HasFactory, SoftDeletes;

    protected $primaryKey = 'uuid';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['uuid', 'slug', 'id_drop', 'user', 'product', 'name', 'address', 'quant', 'price', 'tracking', 'code', 'holder', 'comments', 'option', 'delivery', 'shop', 'pickup', 'signature', 'status'];
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
        return $this->belongsTo(User::class, 'user_id');
    }

    public function setIdDropAttribute($value)
    {
        $this->attributes['id_drop'] = Crypt::encryptString($value);
    }

    public function setUserAttribute($value)
    {
        $this->attributes['user'] = Crypt::encryptString($value);
    }

    public function setProductAttribute($value)
    {
        $this->attributes['product'] = Crypt::encryptString($value);
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = Crypt::encryptString($value);
    }

    public function setAddressAttribute($value)
    {
        $this->attributes['address'] = Crypt::encryptString($value);
    }

    public function setQuantAttribute($value)
    {
        $this->attributes['quant'] = Crypt::encryptString(intval($value));
    }

    public function setPriceAttribute($value)
    {
        $this->attributes['price'] = Crypt::encryptString(floatval($value));
    }

    public function setTrackingAttribute($value)
    {
        $this->attributes['tracking'] = Crypt::encryptString($value);
    }

    public function setCodeAttribute($value)
    {
        $this->attributes['code'] = Crypt::encryptString($value);
    }

    public function setHolderAttribute($value)
    {
        $this->attributes['holder'] = Crypt::encryptString($value);
    }

    public function setCommentsAttribute($value)
    {
        $this->attributes['comments'] = Crypt::encryptString($value);
    }

    public function setOptionAttribute($value)
    {
        $this->attributes['option'] = Crypt::encryptString($value);
    }

    public function setShopAttribute($value)
    {
        $this->attributes['shop'] = Crypt::encryptString($value);
    }

    public function setStatusAttribute($value)
    {
        $this->attributes['status'] = Crypt::encryptString($value);
    }

    // Accessors - Descriptografar ao acessar os valores
    public function getIdDropAttribute($value)
    {
        return Crypt::decryptString($value);
    }

    public function getUserAttribute($value)
    {
        return Crypt::decryptString($value);
    }

    public function getProductAttribute($value)
    {
        return Crypt::decryptString($value);
    }

    public function getNameAttribute($value)
    {
        return Crypt::decryptString($value);
    }

    public function getAddressAttribute($value)
    {
        return Crypt::decryptString($value);
    }

    public function getQuantAttribute($value)
    {
        return Crypt::decryptString($value);
    }

    public function getPriceAttribute($value)
    {
        return Crypt::decryptString($value);
    }

    public function getTrackingAttribute($value)
    {
        return Crypt::decryptString($value);
    }

    public function getCodeAttribute($value)
    {
        return Crypt::decryptString($value);
    }

    public function getHolderAttribute($value)
    {
        return Crypt::decryptString($value);
    }

    public function getCommentsAttribute($value)
    {
        return Crypt::decryptString($value);
    }

    public function getOptionAttribute($value)
    {
        return Crypt::decryptString($value);
    }

    public function getShopAttribute($value)
    {
        return Crypt::decryptString($value);
    }

    public function getStatusAttribute($value)
    {
        return Crypt::decryptString($value);
    }
}
