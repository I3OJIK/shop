<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * AttributeValue model
 *
 * @property int                        $id
 * @property int                        $attribute_id
 * @property string                     $value
 * @property string                     $slug
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 *
 * @property-read Attribute             $attribute
 */
class AttributeValue extends Model
{
    use HasFactory;
    protected $fillable = [

        'attribute_id',
        'value',
        'slug',

    ];

    /**
     * Атрибут, которому принадлежит значение
     */
    public function attribute(): BelongsTo
    {
        return $this->belongsTo(
            Attribute::class
        );
    }
}
