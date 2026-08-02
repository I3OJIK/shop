<?php

namespace App\Data\Responses\Shared;

use App\Models\Category;
use OpenApi\Attributes as OA;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;

#[OA\Schema]
class CategoryTreeData extends Data
{
    public function __construct(
        #[OA\Property(example: 5)]
        public int $id,

        #[OA\Property(example: 'Smartphones')]
        public string $name,

        #[OA\Property(example: 'smartphones')]
        public string $slug,

        #[DataCollectionOf(self::class)]
        public array $children,
    ) {}

    public static function fromModel(Category $category): self
    {
        return new self(
            id: $category->id,
            name: $category->name,
            slug: $category->slug,

            children: self::collect(
                $category->children
            )->all(),
        );
    }
}
