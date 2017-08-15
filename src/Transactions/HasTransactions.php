<?php

/*
 * This file is part of Laravel Rewardable.
 *
 * (c) Brian Faust <hello@brianfaust.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

/*
 * This file is part of Laravel Rewardable.
 *
 * (c) Brian Faust <hello@brianfaust.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BrianFaust\Rewardable\Transactions;

use BrianFaust\Rewardable\Credits\CreditType;
use BrianFaust\Rewardable\Exceptions\InsufficientFundsException;
use BrianFaust\Rewardable\Transactions\Transaction;

trait HasTransactions
{
    /**
     * @return mixed
     */
    public function transactions()
    {
        return $this->morphMany(Transaction::class, 'transaction');
    }

    /**
     * @param $amount
     * @param $typeId
     * @return $this|bool
     * @throws InsufficientFundsException
     */
    public function chargeCredits($amount, $typeId)
    {
        // Check if the type of credit exists
        $type = CreditType::find($typeId);

        if (!$type) {
            return false;
        }

        // check if the Model has sufficient balance to trade
        if ($this->getBalanceByType($type->id) < $amount) {
            throw new InsufficientFundsException(
                $this, $this->id, $this->getBalanceByType($type->id) - $amount
            );
        }

        // All fine, take the cash
        $transaction = (new Transaction())->fill([
            'amount'         => $amount,
            'credit_type_id' => $type->id,
        ]);

        $this->transactions()->save($transaction);

        return $transaction;
    }
}
