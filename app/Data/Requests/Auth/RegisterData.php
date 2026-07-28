<?php

namespace App\Data\Requests\Auth;

use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Attributes\Validation\Email;
use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Attributes\Validation\Unique;
use OpenApi\Attributes as OA;
use Spatie\LaravelData\Attributes\Validation\Confirmed;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Data;

#[OA\Schema(
    required: ["name", "email", "password"]
)]
class RegisterData extends Data
{
    public function __construct(
        #[Required, Max(255)]
        #[OA\Property(example: "John Doe")]
        public string $name,

        #[Required, Email, Unique('users', 'email')]
        #[OA\Property(example: "john@example.com")]
        public string $email,

        #[Required, Min(6), Confirmed]
        #[OA\Property(example: "secret123")]
        public string $password,
    ) {}
}