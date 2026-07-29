<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Category model
 *
 * @property int                            $id             Id
 * @property int|null                       $parent_id      Id родительской категории
 * @property string                         $name           Имя
 * @property string                         $slug           Слаг
 * @property string|null                    $description    Описание
 * @property \Illuminate\Support\Carbon     $created_at     Дата создания
 * @property \Illuminate\Support\Carbon     $updated_at     Дата обновления
 *
 * @property-read Category|null             $parent         
 * @property-read Collection<int, Category> $children
 * @property-read Collection<int, Product>  $products
 */
class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'parent_id',
        'name',
        'slug',
        'description',
    ];

    /**
     * Категоия родитель
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(
            Category::class,
            'parent_id'
        );
    }

    /**
     * Подкатегории
     */
    public function children(): HasMany
    {
        return $this->hasMany(
            Category::class,
            'parent_id'
        );
    }

    /**
     *  Продукты относящиеся к категории
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
