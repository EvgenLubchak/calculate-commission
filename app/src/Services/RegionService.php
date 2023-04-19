<?php

declare(strict_types=1);

namespace App\Services;

use App\Interfaces\DTO\TransactionDTOInterface;
use App\Interfaces\Services\RegionServiceInterface;
use App\Interfaces\Repositories\RegionRepositoryInterface;

class RegionService implements RegionServiceInterface
{
    private RegionRepositoryInterface $regionRepository;

    /**
     * @param RegionRepositoryInterface $regionRepository
     */
    public function __construct(RegionRepositoryInterface $regionRepository)
    {
        $this->regionRepository = $regionRepository;
    }

    /**
     * @param TransactionDTOInterface $transactionDTO
     * @return string
     */
    public function getRegion(TransactionDTOInterface $transactionDTO): string
    {
        return $this->regionRepository->getRegionData($transactionDTO->getBin())?->country?->alpha2;
    }

    /**
     * @param string $region
     * @return bool
     */
    public function isEURegion(string $region): bool
    {
        return in_array($region, $this->regionRepository->getEUCountries());
    }
}
