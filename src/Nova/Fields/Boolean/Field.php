<?php

declare(strict_types = 1);

namespace TCB\Laravel\Nova\Fields\Boolean;

use Laravel\Nova\Fields\Boolean;
use Tool\Str;

/**
 * Class Field
 *
 * Form Field for Booleans. Displays on forms only.
 */
class Field extends Boolean
{
    public function __construct(string $name, string $attribute = null, callable $resolveCallback = null)
    {
        $attribute = Str::make($attribute ?? $name)
            ->trim(' ?')
            ->replace(' ', '_')
            ->toLowerCase()
            ->get();

        parent::__construct($name, $attribute, $resolveCallback);

        $this->onlyOnForms();
    }
}
