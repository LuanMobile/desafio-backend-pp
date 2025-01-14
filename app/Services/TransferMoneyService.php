<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\Transaction\TransactionRepository;
use App\Repositories\Wallet\WalletRepository;
use Illuminate\Support\Facades\Http;

class TransferMoneyService
{

    protected $walletRepository;
    protected $transactionRepository;

    public function __construct(
        WalletRepository $walletRepository,
        TransactionRepository $transactionRepository
    ) {
        $this->walletRepository = $walletRepository;
        $this->transactionRepository = $transactionRepository;
    }

    public function execute(string $user_payer_id, string $user_payee_id, float $amount)
    {
        // dd($user_payer_id, $user_payee_id, $amount);
        $user_commum = User::find($user_payer_id);
        $user_merchant = User::find($user_payee_id);
        $amount = $amount;

        $authorized = $this->is_payment_allowed();
        dd($authorized);
        if ($authorized) {
            # executa a transferencia
        }

    }

    public function is_payment_allowed(): bool
    {
        $authorize = Http::get('https://util.devi.tools/api/v2/authorize');
        $authorize = $authorize->json();
        $authorize = $authorize['data']['authorization'];

        return $authorize;
    }

    public function notify(string $transaction_id): void
    {
        Http::post('https://util.devi.tools/api/v1/notify');
    }
}
