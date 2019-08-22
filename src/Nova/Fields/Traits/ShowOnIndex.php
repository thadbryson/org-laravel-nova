<?php

declare(strict_types = 1);

namespace App\Nova\Fields\Traits;

use Laravel\Nova\Fields\Boolean\Field;

/**
 * Trait ShowOnIndex
 *
 * @mixin Field
 */
trait ShowOnIndex
{
    public function showOnIndex(): self
    {
        $this->showOnIndex = true;

        return $this;
    }
}
