<?php

declare(strict_types = 1);

namespace App\Models\Traits;

trait FromApi
{
    protected $modelFromApi = false;

    /**
     * @return $this
     */
    public function markFromApi()
    {
        $this->modelFromApi = true;

        return $this;
    }

    /**
     * @return $this
     */
    public function unmarkFromApi()
    {
        $this->modelFromApi = false;

        return $this;
    }

    public function isApiCreateNeeded(): bool
    {
        return $this->modelFromApi === false;
    }

    public function isApiUpdateNeeded(): bool
    {
        return $this->modelFromApi === false && empty($this->code) === false;
    }

    public function isApiDeleteNeeded(): bool
    {
        return $this->modelFromApi === false && empty($this->code) === false;
    }
}
