<?php

declare(strict_types = 1);

namespace TCB\Laravel\Nova\Fields;

/**
 * Class Description
 *
 * 255 character max, named "description", with a limit to characters shown of 100
 */
class Description extends \Laravel\Nova\Fields\Text
{
    use Traits\Description {
        __construct as protected __constructTrait;
    }

    /**
     * Maximum length allowed.
     *
     * @var int
     */
    protected $maxLength = 255;

    /**
     * Maximum amount of characters to show on screen without using a <abbr> tag.
     *
     * @var int
     */
    protected $showLimit = 100;

    public function __construct(string $name = 'Description', string $attribute = null, callable $resolveCallback = null)
    {
        $this->__constructTrait($name, $attribute, $resolveCallback);
        $this->asHtml();
        $this->rules(['nullable', 'max:' . $this->maxLength]);
    }
}
