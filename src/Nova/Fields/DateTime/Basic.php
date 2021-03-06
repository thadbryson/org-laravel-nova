<?php

declare(strict_types = 1);

namespace TCB\Laravel\Nova\Fields\DateTime;

use Laravel\Nova\Fields\DateTime;

class Basic extends DateTime
{
    public function __construct(string $name, string $attribute = null, callable $resolveCallback = null)
    {
        parent::__construct($name, $attribute, $resolveCallback);

        $this->sortable()
            ->format('ddd, MMM D YYYY, h:mma');
    }
}
