<?php

namespace App\Http\Controllers;

use App\Services\StockService;
use Illuminate\Http\Request;

class StockController extends Controller
{
    private StockService $stockService;

    public function __construct(StockService $stockService)
    {
        $this->stockService = $stockService;
    }

    public function index()
    {
        try {
            $products = $this->stockService->getAllStocks();
            if (!empty($products)) {
                return response()->json($products);
            } else {
                return response()->json(['error' => 'Stok bulunamadı.'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function show(int $productId)
    {
        try {
            $product = $this->stockService->getStockByProductId($productId);
            if (!empty($product)) {
                return response()->json($product);
            } else {
                return response()->json(['error' => 'Stok bulunamadı.'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    public function store(Request $request)
    {
        try {
            $data = $request->all();
            $stock = $this->stockService->createStock($data);
            if ($stock) {
                return response()->json('Stock başarıyla oluşturuldu.', 201);
            } else {
                return response()->json('Stok oluşturulamadı.', 500);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, int $id)
    {
        try {
            $data = $request->all();
            if ($this->stockService->updateStock($id, $data)) {
                return response()->json('Stok başarıyla güncellendi.', 200);
            } else {
                return response()->json('Stok güncellenemedi.', 500);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy(int $id)
    {
        try {
            if (!empty($this->stockService->getStockById($id))) {
                if ($this->stockService->deleteStock($id)) {
                    return response()->json('Stok başarıyla silindi.', 200);
                } else {
                    return response()->json('Stok silinemedi.', 500);
                }
            } else {
                return response()->json(['error' => 'Stok bulunamadı.'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

}
