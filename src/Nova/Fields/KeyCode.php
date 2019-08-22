<?php

declare(strict_types = 1);

namespace App\Nova\Fields;

use App\Nova\Fields\Traits\ShowOnIndex;

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
