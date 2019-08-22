<?php

declare(strict_types = 1);

namespace TCB\Laravel\Models\Traits;

/**
 * Trait ShowableAction
 *
 * @property bool $is_visible
 */
trait ShowableAction
{
    /**
     * @return $this
     */
    public function show()
    {
        $this->is_visible = true;
        $this->save();

        return $this;
    }

    /**
     * @return $this
     */
    public function hide()
    {
        $this->is_visible = false;
        $this->save();

        return $this;
    }
}
