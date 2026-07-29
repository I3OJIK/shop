<?php

namespace App\Data\Responses\Catalog;

use OpenApi\Attributes as OA;
use Spatie\LaravelData\Data;

#[OA\Schema]
class AvailableOptionData extends Data
{
    public function __construct(

        #[OA\Property(example: 'Color')]
        public string $attribute,


        #[OA\Property(
            example: [
                'Black',
                'Blue',
                'Pink'
            ]
        )]
        public array $values,

    ) {
    }
}