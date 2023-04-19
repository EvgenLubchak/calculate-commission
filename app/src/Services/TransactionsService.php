<?php

declare(strict_types=1);

namespace App\Services;

use App\Interfaces\DTO\TransactionDTOInterface;
use App\Interfaces\Services\TransactionsServiceInterface;
use App\Interfaces\Repositories\TransactionsRepositoryInterface;
use App\DTO\TransactionDTO;

class TransactionsService implements TransactionsServiceInterface
{
    private TransactionsRepositoryInterface $transactionsRepository;

    /**
     * @param TransactionsRepositoryInterface $transactionsRepository
     */
    public function __construct(TransactionsRepositoryInterface $transactionsRepository)
    {
        $this->transactionsRepository = $transactionsRepository;
    }

    /**
     * @return array
     */
    public function getTransactions(): array
    {
        $transactionArray = $this->transactionsRepository->getTransactions();
        return array_map(function($jsonTransaction) {
            return $this->getTransactionDTO(json_decode($jsonTransaction));
        }, $transactionArray);
    }

    /**
     * @param object $transaction
     * @return TransactionDTOInterface
     */
    public function getTransactionDTO(object $transaction): TransactionDTOInterface
    {
        $bin = (int) $transaction->bin;
        $amount = (float) $transaction->amount;
        $currency = $transaction->currency;
        return new TransactionDTO($bin, $amount, $currency);
    }
}
