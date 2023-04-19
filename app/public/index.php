<?php

declare(strict_types=1);

require __DIR__.'/../vendor/autoload.php';

use App\Repositories\TransactionsRepository;
use App\Repositories\RegionRepository;
use App\Repositories\RateRepository;
use App\Services\TransactionsService;
use App\Services\RegionService;
use App\Services\RateService;
use App\Services\CommissionsService;

$transactionsRepository = new TransactionsRepository();
$regionRepository = new RegionRepository();
$rateRepository = new RateRepository();
$transactionService = new TransactionsService($transactionsRepository);
$regionService = new RegionService($regionRepository);
$rateService = new RateService($rateRepository);
$commissionService = new CommissionsService();

//refactored code block, example of services usage
$transactions = $transactionService->getTransactions();
$rates = $rateService->getRates();
foreach ($transactions as $transaction) {
    $isEURegion = $regionService->isEURegion($regionService->getRegion($transaction));
    $rate = $rateService->getRate($rates, $transaction);
    $commission = $commissionService->calculateCommission($transaction, $isEURegion, $rate);
    echo $commission;
    echo '<br>';
}
