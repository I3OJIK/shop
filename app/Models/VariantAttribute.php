<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * VariantAttribute model
 *
 * @property int                        $id
 * @property int                        $product_variant_id
 * @property int                        $attribute_id
 * @property int                        $attribute_value_id
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 *
 * @property-read ProductVariant        $variant
 * @property-read Attribute             $attribute
 * @property-read AttributeValue        $value
 */
class VariantAttribute extends Model
{
    protected $fillable = [

        'product_variant_id',
        'attribute_id',
        'attribute_value_id',

    ];


    /**
     * Вариант продукта, к которому относится атрибут
     */
    public function variant(): BelongsTo
    {
        return $this->belongsTo(
            ProductVariant::class,
            'product_variant_id'
        );
    }

    /**
     * Атрибут
     */
    public function attribute(): BelongsTo
    {
        return $this->belongsTo(
            Attribute::class
        );
    }


    /**
     * Значение атрибута
     */
    public function value(): BelongsTo
    {
        return $this->belongsTo(
            AttributeValue::class,
            'attribute_value_id'
        );
    }
}
