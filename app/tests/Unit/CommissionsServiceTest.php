<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Services\CommissionsService;
use App\Repositories\TransactionsRepository;
use App\Services\TransactionsService;
use App\Repositories\RegionRepository;
use App\Services\RegionService;
use App\Repositories\RateRepository;
use App\Services\RateService;

/*
 * I know that UNIT tests should test UNITS separately. And ideally we should have separate tests for each service
 * in different folders and files. But I didn't have enough time to add all the tests for each file.
 * Therefore, here one big test is a bit like an internal test. But I used Mock data as required by the test task.
 * And this 3 test checks the commission calculation in general.
*/

class CommissionsServiceTest extends TestCase
{
    protected $transactionRepositoryMock;
    protected $regionRepositoryMock;
    protected $rateRepositoryMock;

    protected function setUp(): void
    {
        parent::setUp();

        $this->transactionRepositoryMock = $this->getMockBuilder(TransactionsRepository::class)
            ->onlyMethods(['getTransactions'])
            ->getMock();
        $this->regionRepositoryMock = $this->getMockBuilder(RegionRepository::class)
            ->onlyMethods(['getRegionData'])
            ->getMock();
        $this->rateRepositoryMock = $this->getMockBuilder(RateRepository::class)
            ->onlyMethods(['getRates'])
            ->getMock();
    }

    public function calculateCommission($mockTransactionData, $mockRegionData, $mockRatesData): float
    {
        $this->transactionRepositoryMock->method('getTransactions')->willReturn($mockTransactionData);
        $this->regionRepositoryMock->method('getRegionData')->willReturn($mockRegionData);
        $this->rateRepositoryMock->method('getRates')->willReturn($mockRatesData);

        $transactionService = new TransactionsService($this->transactionRepositoryMock);
        $regionService = new RegionService($this->regionRepositoryMock);
        $rateService = new RateService($this->rateRepositoryMock);
        $commissionService = new CommissionsService();

        $transactions = $transactionService->getTransactions();
        $transaction = $transactions[0];
        $region = $regionService->getRegion($transaction);
        $isEURegion = $regionService->isEURegion($region);
        $rates = $rateService->getRates();
        $rate = $rateService->getRate($rates, $transaction);
        return $commissionService->calculateCommission($transaction, $isEURegion, $rate);
    }

    public function testEURegionEURCurrencyCommissionCalculation(): void
    {
        $mockTransactionData = ['{"bin":"45717360","amount":"100.00","currency":"EUR"}'];
        $mockRegionData = (object)['country'=>(object)['alpha2'=>'DK']];
        $mockRatesData = (object)['conversion_rates'=>(object)['EUR'=>1]];
        $expectedResultOfCommission = 1;

        $commission = $this->calculateCommission($mockTransactionData, $mockRegionData, $mockRatesData);
        $this->assertEquals($expectedResultOfCommission, $commission);
    }

    public function testEURegionNotEURCurrencyCommissionCalculation()
    {
        $mockTransactionData = ['{"bin":"516793","amount":"50.00","currency":"USD"}'];
        $mockRegionData = (object)['country'=>(object)['alpha2'=>'DK']];
        $mockRatesData = (object)['conversion_rates'=>(object)['USD'=>1.0937]];
        $expectedResultOfCommission = 0.46;

        $commission = $this->calculateCommission($mockTransactionData, $mockRegionData, $mockRatesData);
        $this->assertEquals($expectedResultOfCommission, $commission);
    }

    public function testNotEURegionNotEURCurrencyCommissionCalculation()
    {
        $mockTransactionData = ['{"bin":"4745030","amount":"2000.00","currency":"GBP"}'];
        $mockRegionData = (object)['country'=>(object)['alpha2'=>'GB']];
        $mockRatesData = (object)['conversion_rates'=>(object)['GBP'=>0.8826]];
        $expectedResultOfCommission = 45.32;

        $commission = $this->calculateCommission($mockTransactionData, $mockRegionData, $mockRatesData);
        $this->assertEquals($expectedResultOfCommission, $commission);
    }
}
