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
        #[OA\Property(example: 1)]
        public int $id,

        #[DataCollectionOf(CartItemData::class)]
        public array $items,

        #[OA\Property(example: '2999.97')]
        public string $total,

        #[OA\Property(example: '2999.97')]
        public string $selected_total,
    ) {}

    public static function fromModel(Cart $cart): self
    {
        $total = $cart->items->sum(
            fn($item) =>
            (float) bcmul(
                $item->variant->price,
                (string) $item->quantity,
                2
            )
        );

        $selectedTotal = $cart->items
            ->where('is_selected', true)
            ->sum(
                fn($item) => (float) bcmul(
                    $item->variant->price,
                    (string) $item->quantity,
                    2
                )
            );

        return new self(
            id: $cart->id,
            items: CartItemData::collect($cart->items)->all(),
            total: number_format($total, 2, '.', ''),
            selected_total: number_format($selectedTotal, 2, '.', ''),
        );
    }
}
