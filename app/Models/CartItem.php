<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * CartItem model
 *
 * @property int                        $id
 * @property int                        $cart_id
 * @property int                        $product_variant_id
 * @property int                        $quantity
 * @property bool                       $is_selected
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 *
 * @property-read Cart                  $cart
 * @property-read ProductVariant        $variant
 */
class CartItem extends Model
{
    use HasFactory;
    protected $fillable = [

        'cart_id',
        'product_variant_id',
        'quantity',
        'is_selected',

    ];

    protected $casts = [

        'is_selected' => 'boolean',

    ];

    /**
     * Корзина, которой принадлежит элемент
     */
    public function cart(): BelongsTo
    {
        return $this->belongsTo(
            Cart::class
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
