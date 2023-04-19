<?php

namespace App\Interfaces\Repositories;

interface RateRepositoryInterface
{
    /**
     * Get rates object from the third party
     *
     * @return object
     */
    public function getRates(): object;
}
