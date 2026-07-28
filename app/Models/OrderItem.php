<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * OrderItem model
 *
 * @property int                        $id
 * @property int                        $order_id
 * @property int|null                   $product_variant_id
 *
 * @property string                     $product_name
 * @property string                     $sku
 *
 * @property float                      $price
 * @property int                        $quantity
 * @property float                      $total
 *
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 *
 * @property-read Order                 $order
 * @property-read ProductVariant|null   $variant
 */
class OrderItem extends Model
{
    protected $fillable = [

        'order_id',
        'product_variant_id',

        'product_name',
        'sku',

        'price',
        'quantity',
        'total',

    ];

    protected $casts = [

        'price' => 'decimal:2',
        'total' => 'decimal:2',

    ];

    /**
     * Заказ, которому принадлежит элемент заказа
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(
            Order::class
        );
    }

    /**
     * Вариант продукта
     */
    public function variant(): BelongsTo
    {
        return $this->belongsTo(
            ProductVariant::class,
            'product_variant_id'
        );
    }
}
