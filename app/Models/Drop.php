<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;

class Drop extends Model
{
    use HasFactory;

    protected $fillable = ['id_drop', 'name', 'address', 'packages', 'notes', 'status', 'type', 'expired', 'personalnotes', 'slug'];

    protected $dates = ['expired'];

    /**
     * Define o relacionamento com os pedidos (orders).
     */
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
            $drop->personalnotes = $drop->personalnotes ?? 'N/A';
            $drop->status = $drop->status ?? 'Default';
            $drop->type = $drop->type ?? 'All';

            // Atualiza todos os pedidos relacionados com status e notes do drop
            $drop->orders()->update([
                'comments' => $drop->notes
            ]);
        });
    }
}
