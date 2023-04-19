<?php

namespace App\Interfaces\Repositories;

interface TransactionsRepositoryInterface
{
    /**
     * Get transactions data array
     *
     * @return array
     */
    public function getTransactions(): array;
}
