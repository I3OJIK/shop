<?php

namespace App\Data\Responses\Shared;

use App\Models\Category;
use OpenApi\Attributes as OA;
use Spatie\LaravelData\Data;

#[OA\Schema]
class BreadcrumbData extends Data
{
    public function __construct(
        #[OA\Property(example: 1)]
        public int $id,

        #[OA\Property(example: 'Electronics')]
        public string $name,

        #[OA\Property(example: 'electronics')]
        public string $slug,
    ) {
    }

    public static function fromModel(Category $category): self
    {
        return new self(
            id: $category->id,
            name: $category->name,
            slug: $category->slug,
        );
    }
}