<?php

declare(strict_types = 1);

namespace App\Nova\Fields\DateTime;

use Tool\Clock;

class Interval extends WithInterval
{
    public function __construct(string $name, string $attribute = null, callable $resolveCallback = null)
    {
        parent::__construct($name, $attribute, $resolveCallback);

        $this->displayUsing(function ($datetime) {

            $datetime = Clock::makeOrNull($datetime, $this->timezone);

            if ($datetime === null) {
                return '';
            }

            return $this->getIntervalText($datetime);
        });
    }
}
