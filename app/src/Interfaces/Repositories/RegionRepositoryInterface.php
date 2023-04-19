<?php

namespace App\Interfaces\Repositories;

interface RegionRepositoryInterface
{
    /**
     * Get region data object from the third party
     *
     * @param int $bin
     * @return object
     */
    public function getRegionData(int $bin): object;

    /**
     * Get EU countries array
     *
     * @return array
     */
    public function getEUCountries(): array;
}
