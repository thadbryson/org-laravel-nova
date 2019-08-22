<?php

declare(strict_types = 1);

namespace App\Nova\Fields;

/**
 * Class NameLong
 *
 * Long name field. Max 255 characters.
 */
class NameLong extends Name
{
    protected $maxLength = 255;

    protected $showLimit;
}
