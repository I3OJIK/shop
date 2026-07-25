<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Product model
 *
 * @property int                                    $id
 * @property int                                    $brand_id
 * @property int                                    $category_id
 * @property string                                 $name
 * @property string                                 $slug
 * @property string|null                            $description
 * @property bool                                   $is_active
 * @property \Illuminate\Support\Carbon             $created_at
 * @property \Illuminate\Support\Carbon             $updated_at
 *
 * @property-read Brand                             $brand
 * @property-read Category                          $category
 * @property-read Collection<int, ProductVariant>   $variants
 * @property-read Collection<int, ProductAttribute> $attributes
 */
class Product extends Model
{
    protected $fillable = [

        'brand_id',
        'category_id',
        'name',
        'slug',
        'description',
        'is_active',

    ];


    protected $casts = [
        'is_active' => 'boolean',
    ];


    /**
     * Бренд продукта
     */
    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }



    /**
     * Категория продукта
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }


    /**
     * Варианты продукта
     */
    public function variants(): HasMany
    {
        return $this->hasMany(
            ProductVariant::class
        );
    }



    /**
     * Атрибуты продукта
     */
    public function attributes(): HasMany
    {
        return $this->hasMany(
            ProductAttribute::class
        );
    }



    // public function images(): HasMany
    // {
    //     return $this->hasMany(
    //         ProductImage::class
    //     );
    // }
}
