<?php

namespace App\Interfaces\Services;

use App\Interfaces\DTO\TransactionDTOInterface;

interface RateServiceInterface
{
    /**
     * @return object
     */
    public function getRates(): object;

    /**
     * Get current rate from rates object
     *
     * @param object $rates
     * @param TransactionDTOInterface $transaction
     * @return float
     */
    public function getRate(object $rates, TransactionDTOInterface $transaction): float;
}
