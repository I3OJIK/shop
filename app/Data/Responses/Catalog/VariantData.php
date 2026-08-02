<?php

namespace App\Data\Responses\Catalog;

use App\Models\ProductVariant;
use OpenApi\Attributes as OA;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;

#[OA\Schema]
class VariantData extends Data
{
    /**
     * @param array<int, AttributeData> $attributes
     */
    public function __construct(
        #[OA\Property(example: 12)]
        public int $id,

        #[OA\Property(example: 'IPH15-128-BLACK')]
        public string $sku,

        #[OA\Property(example: '999.99')]
        public string $price,

        #[OA\Property(example: 15)]
        public int $stock,

        #[OA\Property(example: true)]
        public bool $is_active,

        #[DataCollectionOf(AttributeData::class)]
        public array $attributes,

        #[DataCollectionOf(ImageData::class)]
        public array $images,
    ) {
    }

    public static function fromModel(ProductVariant $variant): self
    {
        return new self(
            id: $variant->id,
            sku: $variant->sku,
            price: $variant->price,
            stock: $variant->stock,
            is_active: $variant->is_active,

            attributes: AttributeData::collect(
                $variant->attributes
            )->all(),
            images: ImageData::collect(
                $variant->images
            )->all(),
        );
    }
}