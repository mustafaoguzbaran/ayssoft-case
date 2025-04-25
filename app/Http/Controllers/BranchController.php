<?php

namespace App\Http\Controllers;

use App\Services\BranchService;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    protected BranchService $branchService;

    public function __construct(BranchService $branchService)
    {
        $this->branchService = $branchService;
    }

    public function index()
    {
        try {
            $branches = $this->branchService->getAllBranches();
            if (!empty($branches)) {
                return response()->json($branches);
            } else {
                return response()->json(['error' => 'Şubeler bulunamadı!'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function show(int $id)
    {
        try {
            $branch = $this->branchService->getBranchById($id);
            if (!empty($branch)) {
                return response()->json($branch);
            } else {
                return response()->json(['error' => 'Şube bulunamadı!'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    public function store(Request $request)
    {
        try {
            $data = [
                'name' => $request->name,
                'parent_id' => $request->parent_id,
                'location' => $request->location,
            ];
            $branch = $this->branchService->createBranch($data);
            if ($branch) {
                return response()->json('Şube başarıyla oluşturuldu.', 201);
            } else {
                return response()->json('Şube oluşturulamadı.', 500);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, int $id)
    {
        try {
            $data = [
                'name' => $request->name,
                'parent_id' => $request->parent_id,
                'location' => $request->location,
            ];
            $branch = $this->branchService->updateBranch($id, $data);
            if ($branch) {
                return response()->json('Şube başarıyla güncellendi.', 200);
            } else {
                return response()->json('Şube güncellenemedi.', 500);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy(int $id)
    {
        try {
            if (!empty($this->branchService->getBranchById($id))) {
                if ($this->branchService->deleteBranch($id)) {
                    return response()->json('Şube başarıyla silindi.', 200);
                } else {
                    return response()->json('Şube silinemedi.', 500);
                }
            } else {
                return response()->json('Şube bulunamadı.', 404);
            }

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

}
