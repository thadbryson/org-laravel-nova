<?php

declare(strict_types = 1);

namespace TCB\Laravel\Nova\Fields;

/**
 * Class EmailLink
 *
 * Show a link to an e-mail address.
 */
class EmailLink extends Link
{
    /**
     * Text to use for link.
     *
     * @var string
     */
    protected $text = 'E-mail';

    /**
     * Use e-mail text to display.
     *
     * @var bool
     */
    protected $textUseValue = true;

    protected $format = '<a class="%s" href="mailto:%s" %s>%s</a>';

    public function __construct(string $name = 'E-mail', string $attribute = null, callable $resolveCallback = null)
    {
        if ($attribute === null && $name === 'E-mail') {
            $attribute = 'email';
        }

        parent::__construct($name, $attribute, $resolveCallback);

        $this->sortable();
    }
}
