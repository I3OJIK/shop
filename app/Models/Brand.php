<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Brand model
 *  
 * @property int                            $id             Id
 * @property string                         $name           Имя
 * @property string                         $slug           Слаг    
 * @property \Illuminate\Support\Carbon     $created_at     Дата создания
 * @property \Illuminate\Support\Carbon     $updated_at     Дата изменения
 *
 * @property-read Collection<int, Product>  $products
 */
class Brand extends Model
{
    protected $fillable = [
        'name',
        'slug',
    ];

    /**
     * Продукты данного бренда
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
