<?php

namespace App\Data\Responses\Shared;

use OpenApi\Attributes as OA;
use Spatie\LaravelData\Data;

#[OA\Schema]
class CategoryTreeItemData extends Data
{
    public function __construct(
        #[OA\Property(example: 5)]
        public int $id,

        #[OA\Property(example: 'Smartphones')]
        public string $name,

        #[OA\Property(example: 'smartphones')]
        public string $slug,
    ) {
    }
}