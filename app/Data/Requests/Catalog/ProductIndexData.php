<?php

namespace App\Data\Requests\Catalog;

use OpenApi\Attributes as OA;
use Spatie\LaravelData\Attributes\Validation\Between;
use Spatie\LaravelData\Data;

#[OA\Schema]
class ProductIndexData extends Data
{
    /**
     * @param array<string, array<int, string>>|null $attributes
     */
    public function __construct(
        #[OA\Property(example: 'iphone')]
        public ?string $search = null,

        #[OA\Property(example: 'apple')]
        public ?string $brand = null,

        #[OA\Property(example: 'smartphones')]
        public ?string $category = null,

        #[OA\Property(
            example: [
                'color' => ['black', 'blue'],
                'memory' => ['128gb', '256gb'],
            ]
        )]
        public ?array $attributes = null,

        #[OA\Property(example: '500.00')]
        public ?float $price_from = null,

        #[OA\Property(example: '1500.00')]
        public ?float $price_to = null,

        #[OA\Property(example: 'price_asc')]
        public ?string $sort = null,

        #[Between(1, 100)]
        #[OA\Property(example: 15)]
        public int $per_page = 15,

        #[Between(1, 100000)]
        #[OA\Property(example: 1)]
        public int $page = 1,
    ) {
    }
}