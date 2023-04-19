<?php

namespace App\Interfaces\Services;

use App\Interfaces\DTO\TransactionDTOInterface;

interface TransactionsServiceInterface
{
    /**
     * Get transaction DTO based on $transaction object
     *
     * @param object $transaction
     * @return TransactionDTOInterface
     */
    public function getTransactionDTO(object $transaction): TransactionDTOInterface;

    /**
     * @return array
     */
    public function getTransactions(): array;
}
