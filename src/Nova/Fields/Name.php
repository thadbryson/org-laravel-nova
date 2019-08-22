<?php

declare(strict_types = 1);

namespace TCB\Laravel\Nova\Fields;

/**
 * Class Name
 *
 * Name field.
 */
class Name extends Description
{
    /**
     * Max length of this Field.
     *
     * @var int
     */
    protected $maxLength = 50;

    /**
     * @var int Limit to show this many characters.
     */
    protected $showLimit;

    public function __construct(string $name = 'Name', string $attribute = null, callable $resolveCallback = null)
    {
        parent::__construct($name, $attribute, $resolveCallback);

        $this->sortable();
        $this->rules(['required', 'min:1', 'max:' . $this->maxLength]);
    }
}
