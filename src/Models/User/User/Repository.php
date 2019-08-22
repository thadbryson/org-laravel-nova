<?php

declare(strict_types = 1);

namespace App\Models\User\User;

use App\Models\User\User;

class Repository extends \Data\Services\Repository
{
    /**
     * Get User by their API token.
     *
     * @param $token
     * @return User|null
     */
    public function isUserToken(?int $userId, ?string $token): bool
    {
        if ($userId === null || $token === null) {
            return false;
        }

        /** @var User|null $user */
        $user = $this->query()->find($userId, 'api_token');

        return $user instanceof User && $user->api_token === $token;
    }
}
