<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;

class Drop extends Model
{
    use HasFactory;

    protected $fillable = ['id_drop', 'name', 'address', 'packages', 'notes', 'status', 'type', 'expired', 'personalnotes'];

    /**
     * Define o relacionamento com os pedidos (orders).
     */
    public function orders()
    {
        return $this->hasMany(Order::class, 'id_drop', 'id_drop');
    }

    public function user()
    {
        return $this->hasOne(User::class);
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
            $drop->orders()->update(['status' => $drop->status]);

            $drop->orders()->update(['comments' => $drop->notes]);
        });
    }
}
