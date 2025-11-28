<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'sku',
        'category_id',
        'brand_id',
        'short_description',
        'long_description',
        'price',
        'sale_price',
        'stock_qty',
        'weight',
        'status',
        'featured',
        'thumbnail',
    ];

    /**
     * Get the category that owns the product.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the brand that owns the product.
     */
    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    /**
     * Get the product images for the product.
     */
    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class);
    }

    /**
     * Get the reviews for the product.
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Check if product is on sale.
     */
    public function isOnSale(): bool
    {
        return $this->sale_price && $this->sale_price < $this->price;
    }

    /**
     * Get the current price (sale price if on sale, regular price otherwise).
     */
    public function getCurrentPrice(): float
    {
        return $this->isOnSale() ? $this->sale_price : $this->price;
    }

    /**
     * Check if product is in stock.
     */
    public function isInStock(): bool
    {
        return $this->stock_qty > 0;
    }
}
