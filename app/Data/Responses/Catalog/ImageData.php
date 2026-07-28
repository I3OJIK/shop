<?php

namespace App\Data\Responses\Catalog;

use App\Models\ProductImage;
use Illuminate\Support\Facades\Storage;
use OpenApi\Attributes as OA;
use Spatie\LaravelData\Data;

#[OA\Schema]
class ImageData extends Data
{
    public function __construct(
        #[OA\Property(example: 12)]
        public int $id,

        #[OA\Property(
            example: 'https://example.com/storage/products/iphone-15.jpg'
        )]
        public string $url,

        #[OA\Property(example: true)]
        public bool $is_main,
    ) {
    }

    public static function fromModel(ProductImage $image): self
    {
        return new self(
            id: $image->id,
            url: Storage::url($image->path),
            is_main: $image->is_main,
        );
    }
}