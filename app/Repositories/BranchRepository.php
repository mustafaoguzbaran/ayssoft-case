<?php

namespace App\Repositories;

use App\Interfaces\RepositoryInterface;
use App\Models\Branch;
use Illuminate\Database\Eloquent\Model;

class BranchRepository implements RepositoryInterface
{
    protected Branch $branchModel;

    public function __construct(Branch $branchModel)
    {
        $this->branchModel = $branchModel;
    }

    /**
     * Get all branches.
     *
     * @return array|null
     */
    public function all(): ?array
    {
        return $this->branchModel->all()->toArray();
    }

    /**
     * Find a branch by ID.
     *
     * @param int $id
     * @return Model|null
     */
    public function find(int $id): ?Branch
    {
        return Branch::find($id);
    }

    /**
     * Create a new branch.
     *
     * @param array $data
     * @return Model
     */
    public function create(array $data): Model
    {
        return $this->branchModel->create($data);
    }

    /**
     * Update a branch by ID.
     *
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update(int $id, array $data): bool
    {
        return $this->branchModel->find($id)->update($data);
    }

    /**
     * Delete a branch by ID.
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        return $this->branchModel->find($id)->delete();
    }

    /**
     * Get all branches with their children.
     *
     * @param Branch $branch
     * @return array
     */
    public function getRelatives(Branch $branch): array
    {
        $relatives = [];

        if ($branch->parent) {
            $relatives[] = $branch->parent;
        }

        foreach ($branch->children as $child) {
            $relatives[] = $child;
        }

        return $relatives;
    }

}
