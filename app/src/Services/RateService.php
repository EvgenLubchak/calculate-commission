<?php

declare(strict_types=1);

namespace App\Services;

use App\Interfaces\Services\RateServiceInterface;
use App\Interfaces\Repositories\RateRepositoryInterface;
use App\Interfaces\DTO\TransactionDTOInterface;
use InvalidArgumentException;

class RateService implements RateServiceInterface
{
    private RateRepositoryInterface $rateRepository;

    /**
     * @param RateRepositoryInterface $rateRepository
     */
    public function __construct(RateRepositoryInterface $rateRepository)
    {
        $this->rateRepository = $rateRepository;
    }

    /**
     * @return object
     */
    public function getRates(): object
    {
        return $this->rateRepository->getRates();
    }

    /**
     * @param object $rates
     * @param TransactionDTOInterface $transaction
     * @return float
     */
    public function getRate(object $rates, TransactionDTOInterface $transaction): float
    {
        $currency = $transaction->getCurrency();
        if (!property_exists($rates->conversion_rates, $currency)) {
            throw new InvalidArgumentException("Invalid currency: {$currency}");
        }
        return $rates->conversion_rates->$currency;
    }

}