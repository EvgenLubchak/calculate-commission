<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Interfaces\Repositories\RateRepositoryInterface;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\GuzzleException;

class RateRepository implements RateRepositoryInterface
{
    const BASE_CURRENCY = 'EUR';
    const URL_PATH = 'https://v6.exchangerate-api.com/v6/f9649b071eeb6e3cf1004a4a/latest/' . self::BASE_CURRENCY;

    /**
     * @return object
     * @throws GuzzleException
     * @throws Exception
     */
    public function getRates(): object
    {
        $client = new Client();
        try {
            $response = $client->request('GET', self::URL_PATH);
            return json_decode($response->getBody()->getContents());
        } catch (RequestException $e) {
            $statusCode = $e->getResponse()->getStatusCode();
            $mes = $e->getMessage();
            throw new Exception("Error during request to rate API. Status: {$statusCode}. Message: {$mes}");
        }
    }
}