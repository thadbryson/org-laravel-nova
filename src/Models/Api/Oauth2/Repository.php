<?php

declare(strict_types = 1);

namespace App\Models\Api\Oauth2;

use App\Models\Api\Oauth2;

class Repository extends \Data\Services\Repository
{
    public function findToken(string $code): ?Oauth2
    {
        /** @var Oauth2 $found */
        $found = $this->query()
            ->where('code', $code)
            ->latest('expires_at')
            ->first();

        if ($found instanceof Oauth2) {

            // Delete any others.
            $this->query()
                ->where('code', $code)
                ->where('id', '!=', $found->id)
                ->delete();
        }

        return $found;
    }
}
