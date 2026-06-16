<?php

namespace App\Contracts\Services;

use App\Models\Category;

interface CategoryServiceInterface
{
    /**
     * Create a new category within a database transaction.
     *
     * @throws \Exception
     */
    public function createCategory(array $data): Category;

    /**
     * Update an existing category within a database transaction with pessimistic locking.
     *
     * @throws \Exception
     */
    public function updateCategory(Category $category, array $data): Category;
}
