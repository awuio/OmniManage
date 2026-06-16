<?php

namespace App\Services;

use App\Contracts\Services\CategoryServiceInterface;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class CategoryService implements CategoryServiceInterface
{
    /**
     * Create a new category within a database transaction.
     *
     * @throws \Exception
     */
    public function createCategory(array $data): Category
    {
        try {
            DB::beginTransaction();

            $category = Category::create($data);

            DB::commit();

            return $category;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Update an existing category within a database transaction with pessimistic locking.
     *
     * @throws \Exception
     */
    public function updateCategory(Category $category, array $data): Category
    {
        try {
            DB::beginTransaction();

            $lockedCategory = Category::where('id', $category->id)->lockForUpdate()->firstOrFail();
            
            $lockedCategory->update($data);

            DB::commit();

            return $lockedCategory;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
