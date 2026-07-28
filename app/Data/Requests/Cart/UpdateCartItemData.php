<?php

namespace App\Data\Requests\Cart;

use OpenApi\Attributes as OA;
use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Data;

#[OA\Schema]
class UpdateCartItemData extends Data
{
    public function __construct(
        #[Min(1)]
        #[OA\Property(example: 3)]
        public int $quantity,
    ) {
    }
}