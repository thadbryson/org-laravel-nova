<?php

declare(strict_types = 1);

namespace App\Nova\Fields;

/**
 * Class DescriptionLong
 *
 * 255 character max, named "description", with a limit to characters shown of 100
 */
class DescriptionLong extends \Laravel\Nova\Fields\Textarea
{
    use \App\Nova\Fields\Traits\Description;

    /**
     * Maximum length allowed.
     *
     * @var int
     */
    protected $maxLength = 1024;

    /**
     * Maximum amount of characters to show on screen without using a <abbr> tag.
     *
     * @var int
     */
    protected $showLimit = 100;
}
