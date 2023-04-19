<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Interfaces\Repositories\RegionRepositoryInterface;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\GuzzleException;

class RegionRepository implements RegionRepositoryInterface
{
    const BASE_URL_PATH = 'https://lookup.binlist.net/';

    const EU_COUNTRIES = [
        'AT', 'BE', 'BG',
        'CY', 'CZ', 'DE',
        'DK', 'EE', 'ES',
        'FI', 'FR', 'GR',
        'HR', 'HU', 'IE',
        'IT', 'LT', 'LU',
        'LV', 'MT', 'NL',
        'PO', 'PT', 'RO',
        'SE', 'SI', 'SK',
    ];

    /**
     * @param int $bin
     * @return object
     * @throws GuzzleException
     * @throws Exception
     */
    public function getRegionData(int $bin): object
    {
        $client = new Client();
        try {
            $response = $client->request('GET', self::BASE_URL_PATH . $bin);
            return json_decode($response->getBody()->getContents());
        } catch (RequestException $e) {
            $statusCode = $e->getResponse()->getStatusCode();
            $mes = $e->getMessage();
            throw new Exception("Error during request to region API. Status: {$statusCode}. Message: {$mes}");
        }
    }

    /**
     * @return array
     */
    public function getEUCountries(): array
    {
        return self::EU_COUNTRIES;
    }
}
