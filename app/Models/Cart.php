<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;

/**
 * Cart model
 *
 * @property int                            $id
 * @property int                            $user_id
 * @property \Illuminate\Support\Carbon     $created_at
 * @property \Illuminate\Support\Carbon     $updated_at
 *
 * @property-read User                      $user
 * @property-read Collection<int, CartItem> $items
 */
class Cart extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
    ];

    /**
     * Пользователь которому прингадлежит корзина
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Элементы данной корзины
     */
    public function items(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }

    public function scopeWithCartRelations(Builder $query): Builder
    {
        return $query->with([
            'items.variant.product',
            'items.variant.mainImage',
        ]);
    }
}
