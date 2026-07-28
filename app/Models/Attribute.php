<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Attribute model
 *
 * @property int                                    $id
 * @property string                                 $name
 * @property string                                 $slug
 * @property bool                                   $is_variant         Атрибут создан для продукта или для варианта продукта
 * @property \Illuminate\Support\Carbon             $created_at
 * @property \Illuminate\Support\Carbon             $updated_at
 *
 * @property-read Collection<int, AttributeValue>   $values
 * @property-read Collection<int, ProductAttribute> $productAttributes
 * @property-read Collection<int, VariantAttribute> $variantAttributes
 */
class Attribute extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'is_variant',
    ];


    protected $casts = [
        'is_variant' => 'boolean',
    ];

    /**
     * Значения данного атрибута (Color: red, blue, green)
     */
    public function values(): HasMany
    {
        return $this->hasMany(
            AttributeValue::class
        );
    }

    /**
     * Продукты использующие данный атрибут
     */
    public function productAttributes(): HasMany
    {
        return $this->hasMany(
            ProductAttribute::class
        );
    }

    /**
     * Варианты продуктов использующие данный атрибут
     */
    public function variantAttributes(): HasMany
    {
        return $this->hasMany(
            VariantAttribute::class
        );
    }
}
