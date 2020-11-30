<?php

declare(strict_types = 1);

namespace TCB\Laravel\Facades;

use Illuminate\Console\Application;

/**
 * Class Artisan
 *
 * @method static Application command(string $command, callable $callable)
 */
class Artisan extends \Illuminate\Support\Facades\Artisan
{
}
