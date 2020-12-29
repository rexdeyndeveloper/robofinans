<?php
declare(strict_types=1);


namespace App\Services;


use App\Models\Transaction;
use App\Models\Wallet;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Error;
use Exception;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class TransactionService
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }


    public function executeTransaction(Wallet $sourceWallet, Wallet $destinationWallet, $amount)
    {
        try {
            DB::beginTransaction();
            if ($sourceWallet->id === $destinationWallet->id) {
                throw new RuntimeException('You cannot transfer to yourself', 400);
            }
            /** @var Wallet $wallet */
            $wallet = Wallet::query()
                ->sharedLock()
                ->find($sourceWallet->id);
            if (!($wallet->balance >= $amount)) {
                throw new RuntimeException('Not enough money to transfer', 400);
            }
            $wallet->decrement('balance', $amount);
            $destinationWallet->increment('balance', $amount);
            $wallet->save();
            $destinationWallet->save();
            $transaction = new Transaction();
            $transaction->source_wallet_id = $wallet->id;
            $transaction->destination_wallet_id = $destinationWallet->id;
            $transaction->amount = $amount;
            $transaction->save();
            DB::commit();
            return $transaction;
        } catch (RuntimeException | Exception $runtimeException) {
            DB::rollback();
            throw $runtimeException;
        }
    }
}
