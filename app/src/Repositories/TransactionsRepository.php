<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Interfaces\Repositories\TransactionsRepositoryInterface;

class TransactionsRepository implements TransactionsRepositoryInterface
{
    /**
     * @return array
     */
    public function getTransactions(): array
    {
        return explode("\n", file_get_contents(__DIR__ . '/../../files/input.txt'));
    }
}
