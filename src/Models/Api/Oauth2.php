<?php

declare(strict_types = 1);

namespace TCB\Laravel\Models\Api;

use App\Models\Api\Oauth2\Repository;

/**
 * Class Oauth2
 *
 * @method static Repository repository()
 */
final class Oauth2 extends \Data\Models\Api\Oauth2
{
    public static function formSet($code, $token, $tokenRefresh, $expiresInSeconds)
    {
        $current = static::repository()->findToken($code) ?? new static;

        $current->code          = $code;
        $current->token         = $token;
        $current->token_refresh = $tokenRefresh;
        $current->expires_in    = $expiresInSeconds;

        return $current->saveThis();
    }
}
