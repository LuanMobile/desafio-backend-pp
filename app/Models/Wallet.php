<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Wallet extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'balance'
    ];

    // Definir o tipo da chave primária
    protected $keyType = 'string'; // UUID é uma string
    public $incrementing = false; // Desabilitar auto incremento

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Relacionamento com transações (como pagador)
    public function transactionsAsPayer(): HasMany
    {
        return $this->hasMany(Transaction::class, 'payer_wallet_id');
    }

    // Relacionamento com transações (como recebedor)
    public function transactionsAsPayee(): HasMany
    {
        return $this->hasMany(Transaction::class, 'payee_wallet_id');
    }
}
