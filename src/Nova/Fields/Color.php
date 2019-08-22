<?php

declare(strict_types = 1);

namespace App\Nova\Fields;

/**
 * Class Color
 *
 * Default ->sketch() setup.
 */
class Color extends \Timothyasp\Color\Color
{
    public function __construct($name, $attribute = null, $resolveCallback = null)
    {
        parent::__construct($name, $attribute, $resolveCallback);

        $this->sketch();
    }
}
