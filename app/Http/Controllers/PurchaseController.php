<?php

namespace App\Http\Controllers;


use App\Services\BranchService;
use App\Services\StockService;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    protected $stockService;
    protected $branchService;

    public function __construct(StockService $stockService, BranchService $branchService)
    {
        $this->stockService = $stockService;
        $this->branchService = $branchService;
    }

    public function buyProduct(Request $request, int $productId)
    {
        try {
            $requestedBranchId = $request->input('branch_id');

            $result = $this->stockService->attemptPurchaseSmartly($productId, $requestedBranchId, 1);

            if ($result['success']) {
                $fromBranch = $this->branchService->getBranchById($result['purchased_from']);
                $message = $result['was_local']
                    ? 'Ürün bu şubeden satın alındı.'
                    : "Ürün {$fromBranch->name} şubesinden temin edilerek satın alındı.";

                return response()->json([
                    'message' => $message,
                    'branch_id' => $requestedBranchId,
                    'from_branch' => $fromBranch->name,
                ]);
            }

            return response()->json(['error' => 'Hiçbir şubede stok bulunamadı.'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Bir hata oluştu: ' . $e->getMessage()], 500);
        }
    }

}
