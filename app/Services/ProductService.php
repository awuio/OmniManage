<?php

namespace App\Services;

use App\Contracts\Services\ProductServiceInterface;
use App\DataTransferObjects\ProductData;
use App\Models\Product;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductService implements ProductServiceInterface
{
    /**
     * Store a new product and its uploaded image.
     *
     * @throws \Exception
     */
    public function createProduct(ProductData $data, ?UploadedFile $image): Product
    {
        $uploadedImage = null;

        try {
            DB::beginTransaction();

            $productAttributes = $data->toArray();

            if ($image) {
                // Store the uploaded image first
                $uploadedImage = $image->store('products', 'public');
                $productAttributes['image'] = $uploadedImage;
            }

            $product = Product::create($productAttributes);

            DB::commit();

            return $product;
        } catch (\Exception $e) {
            DB::rollBack();

            // Clean up the uploaded image from disk storage if database record creation fails
            if ($uploadedImage) {
                Storage::disk('public')->delete($uploadedImage);
            }

            throw $e;
        }
    }

    /**
     * Update an existing product and its uploaded image.
     *
     * @throws \Exception
     */
    public function updateProduct(Product $product, ProductData $data, ?UploadedFile $image): Product
    {
        $newImageUploaded = null;

        try {
            DB::beginTransaction();

            // Apply pessimistic locking to prevent race conditions during concurrent updates
            $lockedProduct = Product::where('id', $product->id)->lockForUpdate()->firstOrFail();
            $oldImage = $lockedProduct->image;
            
            $productAttributes = $data->toArray();

            if ($image) {
                // Upload new image first, but do not delete old one yet (database integrity)
                $newImageUploaded = $image->store('products', 'public');
                $productAttributes['image'] = $newImageUploaded;
            }

            // Update database record using the locked instance
            $lockedProduct->update($productAttributes);

            DB::commit();

            // If database update succeeds, delete old image to free disk space
            if ($newImageUploaded && $oldImage) {
                Storage::disk('public')->delete($oldImage);
            }

            return $lockedProduct;
        } catch (\Exception $e) {
            DB::rollBack();

            // Clean up the new uploaded image from disk storage if database update fails
            if ($newImageUploaded) {
                Storage::disk('public')->delete($newImageUploaded);
            }

            throw $e;
        }
    }
}
