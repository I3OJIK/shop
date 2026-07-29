<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * ProductAttribute model
 *
 * @property int                        $id
 * @property int                        $product_id
 * @property int                        $attribute_id
 * @property int                        $attribute_value_id
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 *
 * @property-read Product               $product
 * @property-read Attribute             $attribute
 * @property-read AttributeValue        $value
 */
class ProductAttribute extends Model
{
    use HasFactory;
    protected $fillable = [

        'product_id',
        'attribute_id',
        'attribute_value_id',

    ];

    /**
     * Продукт, к которому относится атрибут
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(
            Product::class
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
