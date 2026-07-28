<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * ProductVariant model
 *
 * @property int                                        $id
 * @property int                                        $product_id
 * @property string                                     $sku
 * @property float                                      $price
 * @property int                                        $stock
 * @property bool                                       $is_active
 * @property \Illuminate\Support\Carbon                 $created_at
 * @property \Illuminate\Support\Carbon                 $updated_at
 *
 * @property-read Product                               $product
 * @property-read Collection<int, VariantAttribute>     $variantAttributes
 * @property-read Collection<int, ProductImage>         $images
 * @property-read Collection<int, CartItem>             $cartItems
 */
class ProductVariant extends Model
{
    protected $fillable = [

        'product_id',
        'sku',
        'price',
        'stock',
        'is_active',

    ];

    protected $casts = [

        'price' => 'decimal:2',
        'is_active' => 'boolean',

    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(
            Product::class
        );
    }

    public function variantAttributes(): HasMany
    {
        return $this->hasMany(
            VariantAttribute::class
        );
    }

    public function images(): HasMany
    {
        return $this->hasMany(
            ProductImage::class
        );
    }

    public function mainImage(): HasOne
    {
        return $this->hasOne(ProductImage::class)
            ->where('is_main', true);
    }

    public function cartItems(): HasMany
    {
        return $this->hasMany(
            CartItem::class
        );
    }
}