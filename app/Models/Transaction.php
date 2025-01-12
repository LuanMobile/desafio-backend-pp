<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasFactory;

    // Definir o tipo da chave primária
    protected $keyType = 'string';
    public $incrementing = false; // Desabilitar auto incremento

    protected $fillable = [
        'payer_wallet_id',
        'payee_wallet_id',
        'amount',
        'processed_at'
    ];

     // Relacionamento com o Wallet (Pagador)
     public function payerWallet(): BelongsTo
     {
         return $this->belongsTo(Wallet::class, 'payer_wallet_id');
     }
 
     // Relacionamento com o Wallet (Recebedor)
     public function payeeWallet(): BelongsTo
     {
         return $this->belongsTo(Wallet::class, 'payee_wallet_id');
     }
}
