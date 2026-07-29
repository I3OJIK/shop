<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


/**
 * ProductImage model
 *
 * @property int                        $id
 * @property int                        $product_id
 * @property int|null                   $product_variant_id
 * @property string                     $path
 * @property int                        $sort_order
 * @property bool                       $is_main
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 *
 * @property-read Product               $product
 * @property-read ProductVariant|null   $variant
 */
class ProductImage extends Model
{
    use HasFactory;
    protected $fillable = [

        'product_id',
        'product_variant_id',
        'path',
        'sort_order',
        'is_main',

    ];

    protected $casts = [

        'is_main' => 'boolean',

    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(
            Product::class
        );
    }

    public function variant(): BelongsTo
    {
        return $this->belongsTo(
            ProductVariant::class,
            'product_variant_id'
        );
    }

}