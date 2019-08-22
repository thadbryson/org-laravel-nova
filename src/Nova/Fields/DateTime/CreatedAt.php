<?php

declare(strict_types = 1);

namespace App\Nova\Fields\DateTime;

class CreatedAt extends WithInterval
{
    public function __construct(string $name = 'Created At', string $attribute = null, callable $resolveCallback = null)
    {
        parent::__construct($name, $attribute, $resolveCallback);
    }
}
