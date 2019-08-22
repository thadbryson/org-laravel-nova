<?php

declare(strict_types = 1);

namespace App\Models\Interfaces;

interface IsFromApi
{
    /**
     * @return $this
     */
    public function markFromApi();

    /**
     * @return $this
     */
    public function unmarkFromApi();

    public function isApiCreateNeeded(): bool;

    public function isApiUpdateNeeded(): bool;

    public function isApiDeleteNeeded(): bool;
}
