<?php

namespace App\Repositories\Wallet;

use App\Models\Wallet;

interface WalletRepositoryInterface
{
    public function getWallet(string $user_id);
    public function update(Wallet $wallet);
}
