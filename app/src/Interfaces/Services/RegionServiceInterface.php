<?php

namespace App\Interfaces\Services;

use App\Interfaces\DTO\TransactionDTOInterface;

interface RegionServiceInterface
{
    /**
     * Get transaction region
     *
     * @param TransactionDTOInterface $transactionDTO
     * @return string
     */
    public function getRegion(TransactionDTOInterface $transactionDTO): string;
}
