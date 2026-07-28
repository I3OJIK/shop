<?php


namespace App\Data\Requests\Cart;

use OpenApi\Attributes as OA;
use Spatie\LaravelData\Data;

#[OA\Schema]
class ToggleCartItemData extends Data
{
    public function __construct(
        #[OA\Property(example: true)]
        public bool $is_selected,
    ) {
    }
}