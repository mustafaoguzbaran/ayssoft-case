<?php

namespace App\Services;

use App\Repositories\ProductRepository;
use App\Repositories\StockRepository;
use Illuminate\Database\Eloquent\Model;

class ProductService
{
    protected ProductRepository $productRepository;
    protected StockRepository $stockRepository;

    public function __construct(ProductRepository $productRepository, StockRepository $stockRepository)
    {
        $this->stockRepository = $stockRepository;
        $this->productRepository = $productRepository;
    }

    /**
     * Get all products.
     *
     * @return array|null
     */
    public function getAllProducts(): ?array
    {
        return $this->productRepository->all();
    }

    /**
     * Get a product by ID.
     *
     * @param int $id
     * @return Model|null
     */
    public function getProductById(int $id): ?Model
    {
        return $this->productRepository->find($id);
    }

    /**
     * Create a new product.
     *
     * @param array $data
     * @return ?Model
     */
    public function createProduct(array $data): ?Model
    {
        return $this->productRepository->create($data);
    }

    /**
     * Update a product by ID.
     *
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function updateProduct(int $id, array $data): bool
    {
        return $this->productRepository->update($id, $data);
    }

    /**
     * Delete a product by ID.
     *
     * @param int $id
     * @return bool
     */
    public function deleteProduct(int $id): bool
    {
        return $this->productRepository->delete($id);
    }

}
