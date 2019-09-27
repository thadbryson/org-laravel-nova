<?php

declare(strict_types = 1);

namespace TCB\Laravel\Nova\Fields\Traits;

/**
 * Trait ShowOnIndex
 *
 * @property bool $showOnIndex
 */
trait ShowOnIndex
{
    public function showOnIndex($callback = true): self
    {
        $this->showOnIndex = true;

        return $this;
    }
}
