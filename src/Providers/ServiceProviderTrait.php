<?php

declare(strict_types = 1);

namespace TCB\Laravel\Providers;

use Tool\StrStatic;
use Tool\Validation\Assert;

/**
 * Class ServiceProviderTrait
 *
 * @property-read \Illuminate\Contracts\Foundation\Application $app
 */
trait ServiceProviderTrait
{
    protected function parameters(string $service, array $parameters): self
    {
        foreach ($parameters as $name => $config) {

            $name = StrStatic::ensureLeft($name, '$');

            $this->app->when($service)
                ->needs($name)
                ->give(config($config));
        }

        return $this;
    }

    protected function parametersMany(array $config): self
    {
        foreach ($config as $class => $parameters) {

            Assert::classExists($class);

            $this->parameters($class, $parameters);
        }

        return $this;
    }
}
