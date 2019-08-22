<?php

declare(strict_types = 1);

namespace TCB\Laravel\Nova\Fields;

use TCB\Laravel\Nova\Fields\Traits\ShowOnIndex;

class KeyCode extends \Laravel\Nova\Fields\Text
{
    use ShowOnIndex;

    public function __construct(string $name = 'Code', string $attribute = null, callable $resolveCallback = null)
    {
        parent::__construct($name, $attribute, $resolveCallback);

        $this->hideFromIndex()
            ->sortable()
            ->rules('required', 'string', 'min:1', 'max:255');
    }
}
