<?php

namespace App\Services;

use App\Models\Stock;
use App\Repositories\BranchRepository;
use App\Repositories\StockRepository;
use Illuminate\Database\Eloquent\Model;

class StockService
{
    protected StockRepository $stockRepository;
    protected BranchRepository $branchRepository;

    public function __construct(StockRepository $stockRepository, BranchRepository $branchRepository)
    {
        $this->stockRepository = $stockRepository;
        $this->branchRepository = $branchRepository;
    }

    /**
     * Get all stocks.
     *
     * @return array
     */
    public function getAllStocks(): array
    {
        return $this->stockRepository->all();
    }

    /**
     * Get a stock by product ID.
     *
     * @param int $productId
     * @return Stock|null
     */
    public function getStockByProductId(int $productId): ?Stock
    {
        return $this->stockRepository->findByProductId($productId);
    }

    /**
     * Create a new stock.
     *
     * @param array $data
     * @return bool
     */
    public function createStock(array $data): bool
    {
        if ($this->stockRepository->create($data)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Update a stock by ID.
     *
     * @param int $stockId
     * @param array $data
     * @return bool
     */
    public function updateStock(int $stockId, array $data): bool
    {
        return $this->stockRepository->update($stockId, $data);
    }

    /**
     * Delete a stock by ID.
     *
     * @param int $stockId
     * @return bool
     */
    public function deleteStock(int $stockId): bool
    {
        return $this->stockRepository->delete($stockId);
    }

    /**
     * Get a stock by ID.
     *
     * @param int $stockId
     * @return Model|null
     */
    public function getStockById(int $stockId): ?Model
    {
        return $this->stockRepository->find($stockId);
    }

    /**
     * Attempt to purchase a product from the requested branch.
     *
     * @param int $productId
     * @param int $requestedBranchId
     * @param int $quantity
     * @return array
     */
    public function attemptPurchaseSmartly(int $productId, int $requestedBranchId, int $quantity): array
    {
        $visited = [];
        $branchQueue = [$this->branchRepository->find($requestedBranchId)];

        while (!empty($branchQueue)) {
            $currentBranch = array_shift($branchQueue);

            if (!$currentBranch || in_array($currentBranch->id, $visited)) {
                continue;
            }

            $visited[] = $currentBranch->id;

            $stock = $this->stockRepository->findByProductAndBranch($productId, $currentBranch->id);

            if ($stock && $stock->quantity >= $quantity) {
                $stock->quantity -= $quantity;
                $this->stockRepository->save($stock);

                return [
                    'success' => true,
                    'purchased_from' => $currentBranch->id,
                    'was_local' => $currentBranch->id === $requestedBranchId,
                ];
            }

            foreach ($this->branchRepository->getRelatives($currentBranch) as $relativeBranch) {
                $branchQueue[] = $relativeBranch;
            }
        }

        return [
            'success' => false,
            'purchased_from' => null,
            'was_local' => false,
        ];
    }

}
