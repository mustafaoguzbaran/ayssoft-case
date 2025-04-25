<?php

namespace App\Repositories;

use App\Interfaces\RepositoryInterface;
use App\Models\StockTransfer;
use Illuminate\Database\Eloquent\Model;

class StockTransferRepository implements RepositoryInterface
{
    protected StockTransfer $stockTransferModel;

    public function __construct(StockTransfer $stockTransfer)
    {
        $this->stockTransferModel = $stockTransfer;
    }

    public function all(): ?array
    {
        return $this->stockTransferModel->all()->toArray();
    }

    public function find(int $id): ?Model
    {
        return $this->stockTransferModel->find($id);
    }

    public function create(array $data): ?Model
    {
        return $this->stockTransferModel::create($data);
    }

    public function update(int $id, array $data): bool
    {
        return $this->stockTransferModel::find($id)->update($data);
    }

    public function delete(int $id): bool
    {
        return $this->stockTransferModel::find($id)->delete();
    }

}
