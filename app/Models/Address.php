<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Address model
 * 
 * @property int                            $id
 * @property int                            $user_id
 * @property string                         $phone
 * @property string                         $address_text
 * @property string|null                    $apartment_number
 * @property string|null                    $doorphone
 * @property string|null                    $entrance
 * @property string|null                    $floor
 * 
 * @property-read User                      $user
 */
class Address extends Model
{
    protected $fillable = [
        'user_id',
        'phone',
        'address_text',
        'apartment_number',
        'doorphone',
        'entrance',
        'floor',
    ];

    /**
     * Пользователь которому принадлежит адрес
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
