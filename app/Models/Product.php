<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    /**
     * Fields that are safe to mass-assign.
     * Note: 'views' is intentionally excluded — use incrementViews() instead.
     */
    protected $fillable = [
        'name',
        'description',
        'price',
        'quantity',
        'category_id',
        'image',
    ];

    /**
     * Increment the view counter safely, bypassing mass assignment entirely.
     * Uses a raw SQL UPDATE to avoid race conditions.
     */
    public function incrementViews(): void
    {
        $this->increment('views');
    }

    /**
     * Get the category that owns the product.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
