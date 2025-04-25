<?php

namespace App\Repositories;

use App\Interfaces\RepositoryInterface;
use App\Models\Stock;
use Illuminate\Database\Eloquent\Model;

class StockRepository implements RepositoryInterface
{
    protected Stock $stockModel;

    public function __construct(Stock $stockModel)
    {
        $this->stockModel = $stockModel;
    }

    /**
     * Get all stocks.
     *
     * @return array
     */
    public function all(): array
    {
        return $this->stockModel::all()->toArray();
    }

    /**
     * Find a stock by ID.
     *
     * @param int $id
     * @return Model|null
     */
    public function find(int $id): ?Model
    {
        return $this->stockModel->find($id);
    }

    /**
     * Create a new stock.
     *
     * @param array $data
     * @return Model
     */
    public function create(array $data): Model
    {
        return $this->stockModel::create($data);
    }

    /**
     * Update a stock by ID.
     *
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update(int $id, array $data): bool
    {
        return $this->stockModel::find($id)->update($data);
    }

    /**
     * Delete a stock by ID.
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        return $this->stockModel::find($id)->delete();
    }

    /**
     * Find a stock by product ID.
     *
     * @param int $productId
     * @return Stock|null
     */
    public function findByProductId(int $productId): ?Stock
    {
        return $this->stockModel::where('product_id', $productId)->first();
    }

    public function findByProductAndBranch(int $productId, int $branchId): ?Stock
    {
        return Stock::where('branch_id', $branchId)
            ->where('product_id', $productId)
            ->first();
    }

    /**
     * Save stocks by branch ID.
     *
     * @param Stock $stock
     * @return bool
     */
    public function save(Stock $stock): bool
    {
        return $stock->save();
    }

}
