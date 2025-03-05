<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;
use App\Models\Order;
use Carbon\Carbon;

class Drop extends Model
{
    use HasFactory;

    protected $primaryKey = 'uuid';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['uuid', 'slug', 'id_drop', 'name', 'address', 'packages', 'notes', 'status', 'type', 'expired'];

    protected $dates = ['expired'];

    public function setIdDropAttribute($value)
    {
        $this->attributes['id_drop'] = Crypt::encryptString($value);
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = Crypt::encryptString($value);
    }

    public function setAddressAttribute($value)
    {
        $this->attributes['address'] = Crypt::encryptString($value);
    }

    public function setPackagesAttribute($value)
    {
        $this->attributes['packages'] = Crypt::encryptString($value);
    }

    public function setNotesAttribute($value)
    {
        $this->attributes['notes'] = Crypt::encryptString($value);
    }

    public function setStatusAttribute($value)
    {
        $this->attributes['status'] = Crypt::encryptString($value);
    }

    public function setTypeAttribute($value)
    {
        $this->attributes['type'] = Crypt::encryptString($value);
    }

    // Descriptografar os campos ao acessar no banco
    public function getIdDropAttribute($value)
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

    public function getPackagesAttribute($value)
    {
        return Crypt::decryptString($value);
    }

    public function getNotesAttribute($value)
    {
        return Crypt::decryptString($value);
    }

    public function getStatusAttribute($value)
    {
        return Crypt::decryptString($value);
    }

    public function getTypeAttribute($value)
    {
        return Crypt::decryptString($value);
    }

    //end

    public function orders()
    {
        return $this->hasMany(Order::class, 'id_drop', 'id_drop');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_drop', 'drop_id', 'user_id')->withTimestamps();
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    /**
     * Registra um evento para atualizar automaticamente o campo 'status' nos pedidos associados.
     */
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($drop) {
            // Aplica valores padrão se os campos estiverem nulos
            $drop->notes = $drop->notes ?? 'N/A';
            //$drop->personalnotes = $drop->personalnotes ?? 'N/A';
            $drop->status = $drop->status ?? 'Default';
            $drop->type = $drop->type ?? 'All';

            // Atualiza todos os pedidos relacionados com status e notes do drop
            $drop->orders()->update([
                'comments' => $drop->notes
            ]);
        });
    }
}
