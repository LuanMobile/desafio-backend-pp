<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
}
