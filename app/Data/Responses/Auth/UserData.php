<?php


namespace App\Data\Responses\Auth;

use App\Models\User;
use OpenApi\Attributes as OA;
use Spatie\LaravelData\Data;

#[OA\Schema]
class UserData extends Data
{
    public function __construct(
        #[OA\Property]
        public int $id,

        #[OA\Property]
        public string $name,

        #[OA\Property]
        public string $email,
    ) {
    }

    public static function fromModel(User $user): self
    {
        return new self(
            id: $user->id,
            name: $user->name,
            email: $user->email,
        );
    }
}