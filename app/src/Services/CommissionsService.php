<?php

declare(strict_types=1);

namespace App\Services;

use App\Interfaces\Services\CommissionsServiceInterface;
use App\Interfaces\DTO\TransactionDTOInterface as TransactionDTO;
use InvalidArgumentException;

class CommissionsService implements CommissionsServiceInterface
{
    const EU_COMMISSION_RATE = 0.01;
    const NON_EU_COMMISSION_RATE = 0.02;

    /**
     * @param TransactionDTO $transactionDTO
     * @param bool $isEURegion
     * @param float $rate
     * @return float
     */
    public function calculateCommission(TransactionDTO $transactionDTO, bool $isEURegion, float $rate): float
    {
        if (!is_numeric($rate) || $rate <= 0) {
            throw new InvalidArgumentException("Invalid exchange rate: {$rate}");
        }
        $transactionAmount = $transactionDTO->getAmount();
        $amountFixed = $transactionDTO->getCurrency() === 'EUR' ? $transactionAmount : $transactionAmount / $rate;
        $commissionRate = $isEURegion ? self::EU_COMMISSION_RATE : self::NON_EU_COMMISSION_RATE;
        $commission = $amountFixed * $commissionRate;
        return (float)number_format($commission, 2, '.', '');
    }
}
