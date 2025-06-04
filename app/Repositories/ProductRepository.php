<?php

namespace App\Repositories;

use App\Interfaces\RepositoryInterface;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class ProductRepository implements RepositoryInterface
{
    protected $productModel;

    public function __construct(Product $productModel)
    {
        $this->productModel = $productModel;
    }

    /**
     * Get all products.
     *
     * @return array|null
     */
    public function all(): ?array
    {
        return $this->productModel::all()->toArray();
    }

    /**
     * Find a product by ID.
     *
     * @param int $id
     * @return Model|null
     */
    public function find(int $id): ?Model
    {
        return $this->productModel->find($id);
    }

    /**
     * Create a new product.
     *
     * @param array $data
     * @return ?Model
     */
    public function create(array $data): ?Model
    {
        return $this->productModel::create($data);
    }

    /**
     * Update a product by ID.
     *
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update(int $id, array $data): bool
    {
        return $this->productModel::find($id)->update($data);
    }

    /**
     * Delete a product by ID.
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        return $this->productModel::find($id)->delete();
    }

}
