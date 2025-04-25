<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Services\ProductService;

class ProductController extends Controller
{
    private ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        try {
            $products = $this->productService->getAllProducts();
            if (!empty($products)) {
                return response()->json($products);
            } else {
                return response()->json(['error' => 'Ürünler bulunamadı!'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function show(int $id)
    {
        try {
            $product = $this->productService->getProductById($id);
            if (!empty($product)) {
                return response()->json($product);
            } else {
                return response()->json(['error' => 'Ürün bulunamadı!'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    public function store(ProductRequest $request)
    {
        try {
            $data = [
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'sku' => $request->sku,
            ];

            $product = $this->productService->createProduct($data);
            if (!empty($product)) {
                return response()->json('Ürün başarıyla oluşturuldu!', 201);
            } else {
                return response()->json('Ürün oluşturulamadı.', 500);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(ProductRequest $productRequest, int $id)
    {
        try {
            $data = [
                'name' => $productRequest->name,
                'description' => $productRequest->description,
                'price' => $productRequest->price,
                'sku' => $productRequest->sku,
            ];

            $product = $this->productService->updateProduct($id, $data);
            if (!empty($product)) {
                return response()->json('Ürün başarıyla güncellendi!');
            } else {
                return response()->json('Ürün güncellenemedi.', 500);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy(int $id)
    {
        try {
            if ($this->productService->getProductById($id)) {
                if ($this->productService->deleteProduct($id)) {
                    return response()->json("Ürün başarıyla silindi!", 204);
                } else {
                    return response()->json(['error' => 'Ürün silinemedi!'], 500);
                }
            } else {
                return response()->json(['error' => 'Ürün bulunamadı!'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

}
