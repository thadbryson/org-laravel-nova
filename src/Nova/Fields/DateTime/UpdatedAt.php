<?php

declare(strict_types = 1);

namespace App\Nova\Fields\DateTime;

class UpdatedAt extends WithInterval
{
    public function __construct(string $name = 'Updated At', string $attribute = null, callable $resolveCallback = null)
    {
        parent::__construct($name, $attribute, $resolveCallback);
    }
}
