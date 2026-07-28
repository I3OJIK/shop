<?php

namespace App\Data\Responses\Catalog;

use App\Models\Product;
use OpenApi\Attributes as OA;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;

#[OA\Schema]
class ProductDetailsData extends Data
{
    /**
     * @param array<int, AttributeData> $attributes
     * @param array<int, VariantData> $variants
     * @param array<int, ImageData> $images
     */
    public function __construct(
        #[OA\Property(example: 15)]
        public int $id,

        #[OA\Property(example: 'iPhone 15')]
        public string $name,

        #[OA\Property(example: 'iphone-15')]
        public string $slug,

        #[OA\Property(example: 'Описание товара')]
        public ?string $description,

        public BrandData $brand,

        public CategoryData $category,

        #[DataCollectionOf(AttributeData::class)]
        public array $attributes,

        #[DataCollectionOf(VariantData::class)]
        public array $variants,

        #[DataCollectionOf(ImageData::class)]
        public array $images,
    ) {
    }

    public static function fromModel(Product $product): self
    {
        return new self(
            id: $product->id,

            name: $product->name,

            slug: $product->slug,

            description: $product->description,

            brand: BrandData::fromModel($product->brand),

            category: CategoryData::fromModel($product->category),

            attributes: AttributeData::collect(
                $product->productAttributes
            )->all(),

            variants: VariantData::collect(
                $product->variants
            )->all(),

            images: ImageData::collect(
                $product->images
            )->all(),
        );
    }
}