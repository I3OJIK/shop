<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Order model
 *
 * @property int                                $id
 * @property int                                $user_id
 * @property string                             $status
 * @property float                              $total_price
 * @property string                             $phone
 * @property string                             $address_text
 * @property string|null                        $apartment_number
 * @property string|null                        $doorphone
 * @property string|null                        $entrance
 * @property string|null                        $floor
 *
 * @property \Illuminate\Support\Carbon         $created_at
 * @property \Illuminate\Support\Carbon         $updated_at
 *
 * @property-read User                          $user
 * @property-read Collection<int, OrderItem>    $items
 */
class Order extends Model
{
    protected $fillable = [
        'user_id',
        'status',
        'total_price',

        'phone',
        'address_text',
        'apartment_number',
        'doorphone',
        'entrance',
        'floor',
        'comment',
    ];

    protected $casts = [

        'total_price' => 'decimal:2',

    ];

    /**
     * Пользователь, которму принадлежит заказ
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(
            User::class
        );
    }

    /**
     * Элементы, входящие в заказ
     */
    public function items(): HasMany
    {
        return $this->hasMany(
            OrderItem::class
        );
    }
}
