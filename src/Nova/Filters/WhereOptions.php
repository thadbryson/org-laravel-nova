<?php

declare(strict_types = 1);

namespace TCB\Nova\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Laravel\Nova\Filters\BooleanFilter;

class WhereOptions extends BooleanFilter
{
    /**
     * Options to choose [title => value]
     *
     * @var array
     */
    protected $options;

    /**
     * Options that are selected by default.
     *
     * @var array
     */
    protected $defaults;

    protected $operator = '=';

    protected $whereValue = true;

    public function __construct(string $name, array $options, array $defaults = [])
    {
        $this->name = $name;

        $this->options  = $options;
        $this->defaults = $defaults;
    }

    public function apply(Request $request, $query, $value)
    {
        foreach ($this->options as $key) {

            if ($value[$key] === true) {

                /** @var Builder $query */
                return $query->where($key, $this->operator, $this->whereValue);
            }
        }

        return $query;
    }

    public function options(Request $request): array
    {
        return $this->options;
    }

    public function default(): array
    {
        return $this->defaults;
    }

    public function setOperator(string $operator): self
    {
        $this->operator = $operator;

        return $this;
    }

    public function setWhereValue($value): self
    {
        $this->whereValue = $value;

        return $this;
    }
}
