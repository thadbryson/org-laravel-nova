<?php

declare(strict_types = 1);

namespace TCB\Laravel\Nova\Fields;

/**
 * Class ID
 *
 * ID field.
 */
class ID extends \Laravel\Nova\Fields\ID
{
    public function __construct(string $name = null, string $attribute = null, callable $resolveCallback = null)
    {
        parent::__construct($name, $attribute, $resolveCallback);

        $this->sortable();
    }
}
