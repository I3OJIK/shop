<?php

namespace App\Data\Responses\Cart;

use App\Models\Cart;
use OpenApi\Attributes as OA;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;

#[OA\Schema]
class CartData extends Data
{
    /**
     * @param array<int, CartItemData> $items
     */
    public function __construct(
        #[DataCollectionOf(CartItemData::class)]
        public array $items,

        #[OA\Property(example: 3)]
        public int $items_count,

        #[OA\Property(example: '2999.97')]
        public string $total,
    ) {
    }
}