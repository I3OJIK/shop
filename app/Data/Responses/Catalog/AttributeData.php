<?php

namespace App\Data\Responses\Catalog;

use App\Models\VariantAttribute;
use OpenApi\Attributes as OA;
use Spatie\LaravelData\Data;

#[OA\Schema]
class AttributeData extends Data
{
    public function __construct(
        #[OA\Property(example: 1)]
        public int $id,

        #[OA\Property(example: 'Color')]
        public string $name,

        #[OA\Property(example: 'color')]
        public string $slug,

        #[OA\Property(example: 5)]
        public int $value_id,

        #[OA\Property(example: 'Blue')]
        public string $value,

        #[OA\Property(example: 'blue')]
        public string $value_slug,
    ) {}

    public static function fromModel(VariantAttribute $attribute): self
    {
        return new self(
            id: $attribute->attribute->id,
            name: $attribute->attribute->name,
            slug: $attribute->attribute->slug,

            value_id: $attribute->value->id,
            value: $attribute->value->value,
            value_slug: $attribute->value->slug,
        );
    }
}
