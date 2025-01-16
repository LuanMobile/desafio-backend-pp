<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Wallet;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Cria 10 usuários e, para cada um, cria uma wallet associada
        User::factory(10)->create()->each(function ($user) {
            Wallet::factory()->create(['user_id' => $user->id]);
        });
    }
}
