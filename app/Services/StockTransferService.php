<?php

namespace App\Services;

use App\Repositories\StockTransferRepository;

class StockTransferService
{
    protected StockTransferRepository $stockTransferRepository;
    protected StockService $stockService;
    public function __construct(StockTransferRepository $stockTransferRepository, StockService $stockService)
    {
        $this->stockTransferRepository = $stockTransferRepository;
        $this->stockService = $stockService;
    }

}
