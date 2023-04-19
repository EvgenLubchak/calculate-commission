<?php

namespace App\Interfaces\Services;

use App\Interfaces\DTO\TransactionDTOInterface as TransactionDTO;

interface CommissionsServiceInterface
{
    /**
     * Calculate commission
     *
     * @param TransactionDTO $transactionDTO
     * @param bool $isEURegion
     * @param float $rate
     * @return float
     */
    public function calculateCommission(TransactionDTO $transactionDTO, bool $isEURegion, float $rate): float;
}
