<?php

namespace App\Contracts\Services;

use App\DataTransferObjects\ProductData;
use App\Models\Product;
use Illuminate\Http\UploadedFile;

interface ProductServiceInterface
{
    /**
     * Store a new product and its uploaded image.
     *
     * @throws \Exception
     */
    public function createProduct(ProductData $data, ?UploadedFile $image): Product;

    /**
     * Update an existing product and its uploaded image.
     *
     * @throws \Exception
     */
    public function updateProduct(Product $product, ProductData $data, ?UploadedFile $image): Product;
}
