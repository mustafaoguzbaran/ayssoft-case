<?php

namespace App\Services;

use App\Repositories\BranchRepository;
use Illuminate\Database\Eloquent\Model;

class BranchService
{
    protected BranchRepository $branchRepository;

    public function __construct(BranchRepository $branchRepository)
    {
        $this->branchRepository = $branchRepository;
    }

    /**
     * Get all branches.
     *
     * @return array|null
     */
    public function getAllBranches(): ?array
    {
        return $this->branchRepository->all();
    }

    /**
     * Get a branch by ID.
     *
     * @param int $id
     * @return \App\Models\Branch|Model
     */
    public function getBranchById(int $id): \App\Models\Branch|Model
    {
        return $this->branchRepository->find($id);
    }

    /**
     * Create a new branch.
     *
     * @param array $data
     * @return Model
     */
    public function createBranch(array $data): Model
    {
        return $this->branchRepository->create($data);
    }

    /**
     * Update a branch by ID.
     *
     * @param int $id
     * @param array $data
     * @return bool|null
     */
    public function updateBranch(int $id, array $data): ?bool
    {
        return $this->branchRepository->update($id, $data);
    }

    /**
     * Delete a branch by ID.
     *
     * @param int $id
     * @return bool|null
     */
    public function deleteBranch(int $id): ?bool
    {
        return $this->branchRepository->delete($id);
    }

}
