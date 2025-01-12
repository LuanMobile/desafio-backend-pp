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
        Schema::create('wallets', function (Blueprint $table) {
            $table->uuid('id')->primary(); // UUID para a chave primária da wallet
            $table->uuid('user_id'); // Chave estrangeira UUID
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->unique(); // Chave estrangeira para o user
            $table->enum('type', ['common', 'merchant']);
            $table->decimal('balance', 10, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wallets');
    }
};
