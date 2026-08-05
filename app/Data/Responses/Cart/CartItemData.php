<?php

namespace App\Data\Responses\Cart;

use App\Data\Responses\Catalog\ImageData;
use App\Models\CartItem;
use OpenApi\Attributes as OA;
use Spatie\LaravelData\Data;

#[OA\Schema]
class CartItemData extends Data
{
    public function __construct(
        #[OA\Property(example: 5)]
        public int $id,

        #[OA\Property(example: 12)]
        public int $product_variant_id,

        #[OA\Property(example: 'iPhone 15')]
        public string $product_name,

        #[OA\Property(example: 'IPH15-128-BLACK')]
        public string $sku,

        #[OA\Property(example: '999.99')]
        public string $price,

        #[OA\Property(example: 2)]
        public int $quantity,

        #[OA\Property(example: '1999.98')]
        public string $total,

        #[OA\Property(example: true)]
        public bool $is_selected,

        public ?ImageData $image,
    ) {
    }

    public static function fromModel(CartItem $item): self
    {
        $variant = $item->variant;

        return new self(
            id: $item->id,

            product_variant_id: $variant->id,

            product_name: $variant->product->name,

            sku: $variant->sku,

            price: $variant->price,

            quantity: $item->quantity,

            total: bcmul(
                $variant->price,
                (string) $item->quantity,
                2
            ),

            is_selected: $item->is_selected,

            image: $variant->mainImage
                ? ImageData::fromModel($variant->mainImage)
                : null,
        );
    }
}