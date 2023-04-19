<?php

declare(strict_types=1);

namespace App\DTO;

use App\Interfaces\DTO\TransactionDTOInterface;

class TransactionDTO implements TransactionDTOInterface
{
    private int $bin;
    private float $amount;
    private string $currency;

    /**
     * @param int $bin
     * @param float $amount
     * @param string $currency
     */
    public function __construct(int $bin, float $amount, string $currency)
    {
        $this->bin = $bin;
        $this->amount = $amount;
        $this->currency = $currency;
    }

    /**
     * @return int
     */
    public function getBin(): int
    {
        return $this->bin;
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }
}
