<?php

declare(strict_types = 1);

namespace TCB\Laravel\Facades;

use Laravel\Nova\PendingRouteRegistration;

/**
 * Class Nova
 *
 * @method static PendingRouteRegistration routes()
 * @method static void provideToScript(array $resources)
 * @method static string version()
 * @method static void resourcesIn(string $directoryPath)
 */
class Nova extends \Laravel\Nova\Nova
{
}
