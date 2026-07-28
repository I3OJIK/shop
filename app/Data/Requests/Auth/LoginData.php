<?php

namespace App\Data\Requests\Auth;

use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Attributes\Validation\Email;
use Spatie\LaravelData\Attributes\Validation\Exists;
use OpenApi\Attributes as OA;
use Spatie\LaravelData\Data;

#[OA\Schema(
    required: ["email", "password"]
)]
class LoginData extends Data
{
    public function __construct(
        #[Required, Email, Exists('users', 'email')]
        #[OA\Property(example: "john@example.com")]   
        public string $email,

        #[Required]
        #[OA\Property(example: "secret123")]
        public string $password,
    ) {}
}