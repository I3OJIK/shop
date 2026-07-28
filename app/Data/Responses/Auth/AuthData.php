<?php

namespace App\Data\Responses\Auth;

use OpenApi\Attributes as OA;
use Spatie\LaravelData\Data;

#[OA\Schema]
class AuthData extends Data
{
    public function __construct(
        #[OA\Property]
        public string $token,

        public UserData $user,
    ) {
    }
}