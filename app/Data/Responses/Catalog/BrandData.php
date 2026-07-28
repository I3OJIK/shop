<?php

namespace App\Data\Responses\Catalog;

use App\Models\Brand;
use OpenApi\Attributes as OA;
use Spatie\LaravelData\Data;

#[OA\Schema]
class BrandData extends Data
{
    public function __construct(
        #[OA\Property(example: 1)]
        public int $id,

        #[OA\Property(example: 'Apple')]
        public string $name,

        #[OA\Property(example: 'apple')]
        public string $slug,
    ) {
    }

    public static function fromModel(Brand $brand): self
    {
        return new self(
            id: $brand->id,
            name: $brand->name,
            slug: $brand->slug,
        );
    }
}