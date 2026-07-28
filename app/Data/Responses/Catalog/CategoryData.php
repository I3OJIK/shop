<?php

namespace App\Data\Responses\Catalog;

use App\Models\Category;
use OpenApi\Attributes as OA;
use Spatie\LaravelData\Data;

#[OA\Schema]
class CategoryData extends Data
{
    public function __construct(
        #[OA\Property(example: 3)]
        public int $id,

        #[OA\Property(example: 'Smartphones')]
        public string $name,

        #[OA\Property(example: 'smartphones')]
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