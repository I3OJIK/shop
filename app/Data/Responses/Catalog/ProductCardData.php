<?php

namespace App\Data\Responses\Catalog;

use App\Builders\ProductOptionsBuilder;
use App\Models\Product;
use Illuminate\Support\Collection;
use OpenApi\Attributes as OA;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;

#[OA\Schema]
class ProductCardData extends Data
{
    public function __construct(
        #[OA\Property(example: 25)]
        public int $id,

        #[OA\Property(example: 'iPhone 15')]
        public string $name,

        #[OA\Property(example: 'iphone-15')]
        public string $slug,

        #[OA\Property(example: '999.99')]
        public string $price,

        /**
         * Доступные варианты выбора товара.
         *
         * Например:
         *
         * Color:
         *  - Black
         *  - Blue
         *
         * Storage:
         *  - 128GB
         *  - 256GB
         */
        #[DataCollectionOf(AvailableOptionData::class)]
        public Collection $available_options,

        public BrandData $brand,

        public CategoryData $category,

        public ?ImageData $image,


    ) {
    }

    public static function fromModel(Product $product): self
    {
        return new self(
            id: $product->id,
            name: $product->name,
            slug: $product->slug,

            // Загружаем через withMin('variants', 'price')
            price: (string) $product->variants_min_price,

            available_options: app(ProductOptionsBuilder::class)
            ->build($product),

            brand: BrandData::fromModel($product->brand),

            category: CategoryData::fromModel($product->category),

            image: $product->mainImage
                ? ImageData::fromModel($product->mainImage)
                : null,
        );
    }
}