<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->uuid('id')->primary(); // UUID como chave primária
            $table->uuid('payer_wallet_id'); // Chave estrangeira para o wallet do pagador
            $table->uuid('payee_wallet_id'); // Chave estrangeira para o wallet do recebedor
            $table->decimal('amount', 10, 2); // Valor da transação
            $table->timestamp('processed_at')->nullable(); // Data/hora de processamento

            // Definir as chaves estrangeiras
            $table->foreign('payer_wallet_id')->references('id')->on('wallets')->onDelete('cascade');
            $table->foreign('payee_wallet_id')->references('id')->on('wallets')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
