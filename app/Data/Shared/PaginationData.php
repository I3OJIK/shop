<?php

namespace App\Data\Shared;

use OpenApi\Attributes as OA;
use Spatie\LaravelData\Data;

#[OA\Schema]
class PaginationData extends Data
{
    public function __construct(
        public int $page = 1,

        public int $per_page = 15,
    ) {
    }
}