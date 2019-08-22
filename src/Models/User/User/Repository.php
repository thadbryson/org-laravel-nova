<?php

declare(strict_types = 1);

namespace TCB\Laravel\Models\User\User;

use TCB\Laravel\Models\User\User;

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
