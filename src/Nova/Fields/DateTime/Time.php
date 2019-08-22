<?php

declare(strict_types = 1);

namespace TCB\Laravel\Nova\Fields\DateTime;

use Exception;
use Laravel\Nova\Http\Requests\NovaRequest;
use Tool\Clock;

/**
 * Class Time
 *
 * Basic HTML5 time field.
 *
 * @method static make(string $name, string $attribute = null, callable $resolveCallback = null)
 */
class Time extends \Laravel\Nova\Fields\Field
{
    /**
     * Using vendor's component and I'm extending here.
     *
     * @var string
     */
    public $component = 'nova-time-field';

    /**
     * Create a new field.
     *
     * @param string        $name
     * @param string|null   $attribute       = null
     * @param callable|null $resolveCallback = null
     *
     * @return void
     */
    public function __construct(string $name, string $attribute = null, callable $resolveCallback = null)
    {
        parent::__construct($name, $attribute, $resolveCallback ?? $resolveCallback = function ($value) {

                $format = $this->meta['format'] ?? 'g:ia';

                return Clock::createFromFormat('H:i:s', $value)->format($format);
            });

        $this->with12HourTime();
    }

    public function format(string $format): self
    {
        return $this->withMeta(['format' => $format]);
    }

    public function with12HourTime(bool $hour12 = true): self
    {
        return $this->withMeta(['twelveHourTime' => $hour12]);
    }

    /**
     * Hydrate the given attribute on the model based on the incoming request.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @param string                                  $requestAttribute
     * @param object                                  $model
     * @param string                                  $attribute
     *
     * @return void
     * @throws Exception
     */
    protected function fillAttributeFromRequest(NovaRequest $request, $requestAttribute, $model, $attribute): void
    {
        if ($request->exists($requestAttribute) && $request[$requestAttribute]) {
            $sentData = $request[$requestAttribute];

            $model->{$attribute} = $sentData;
        }
    }
}
