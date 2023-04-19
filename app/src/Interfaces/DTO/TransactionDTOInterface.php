<?php

namespace App\Interfaces\DTO;

interface TransactionDTOInterface
{
    /**
     * Get bin val
     *
     * @return int
     */
    public function getBin(): int;

    /**
     * Get amount val
     *
     * @return float
     */
    public function getAmount(): float;

    /**
     * Get currency val
     *
     * @return string
     */
    public function getCurrency(): string;
}
