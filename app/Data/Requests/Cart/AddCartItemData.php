<?php

namespace App\Data\Requests\Cart;

use OpenApi\Attributes as OA;
use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Data;

#[OA\Schema]
class AddCartItemData extends Data
{
    public function __construct(
        #[Min(1)]
        #[OA\Property(example: 12)]
        public int $product_variant_id,

        #[Min(1)]
        #[OA\Property(example: 1)]
        public int $quantity = 1,
    ) {
    }
}