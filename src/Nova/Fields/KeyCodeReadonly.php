<?php

declare(strict_types = 1);

namespace App\Nova\Fields;

class KeyCodeReadonly extends KeyCode
{
    public function __construct(string $name = 'Code', string $attribute = null, callable $resolveCallback = null)
    {
        parent::__construct($name, $attribute, $resolveCallback);

        $this
            ->exceptOnForms()
            ->readonly(function () {

                return true;
            });
    }
}
