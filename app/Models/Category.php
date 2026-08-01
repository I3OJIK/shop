<?php

namespace App\Models;

use Aimeos\Nestedset\NodeTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Category model
 *
 * @property int                            $id             Id
 * @property string                         $name           Имя
 * @property string                         $slug           Слаг
 * @property string|null                    $description    Описание
 * @property \Illuminate\Support\Carbon     $created_at     Дата создания
 * @property \Illuminate\Support\Carbon     $updated_at     Дата обновления
 *
 * @property-read Collection<int, Product>  $products
 */
class Category extends Model
{
    use NodeTrait;
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
        'description',
    ];

    /**
     *  Продукты относящиеся к категории
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
