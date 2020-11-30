<?php

declare(strict_types = 1);

namespace TCB\Laravel\Nova\Fields\DateTime;

use DateTimeZone;
use Laravel\Nova\Fields\Text;
use Tool\Clock;
use function date_default_timezone_get;

/**
 * Class Future
 *
 * For DateTime fieldss that are in the past.
 */
class WithInterval extends Text
{
    /**
     * PHP DateTime format string. https://php.net/date
     *
     * @var string
     */
    protected $format;

    /**
     * Use short interval format?
     *
     * @var bool
     */
    protected $formatIntervalShort = true;

    /**
     * Show interval in <abbr> tag?
     *
     * @var bool
     */
    protected $withInterval = true;

    /**
     * Timezone for all date objects.
     *
     * @var string|int|DateTimeZone
     */
    protected $timezone;

    /**
     * Text before the DateTime string.
     *
     * @var string
     */
    protected $pastText = '%s ago';

    /**
     * Text after the DateTime string.
     *
     * @var string
     */
    protected $futureText = 'In %s';

    public function __construct(string $name, string $attribute = null, callable $resolveCallback = null)
    {
        parent::__construct($name, $attribute, $resolveCallback);

        $this->format('D M j, Y g:ia')
            ->asHtml()
            ->sortable()
            ->displayUsing(function ($datetime) {

                return $this->getAbbrHtml($datetime);
            });
    }

    public function format(string $format): self
    {
        $this->format = $format;

        return $this;
    }

    protected function getAbbrHtml($datetime): string
    {
        $datetime = Clock::makeOrNull($datetime, $this->timezone ?? date_default_timezone_get());

        if ($datetime instanceof Clock) {

            if ($this->withInterval === false) {
                return $datetime->format($this->format);
            }

            return sprintf('<abbr title="%s">%s</abbr>', $this->getIntervalText($datetime), $datetime->format($this->format));
        }

        return '';
    }

    protected function getIntervalText(Clock $datetime): string
    {
        $text = $datetime->diffAsCarbonInterval()
            // Hide the seconds text.
            ->seconds(0)
            ->forHumans($this->formatIntervalShort);

        if ($datetime->isPast()) {
            return sprintf($this->pastText, $text);
        }

        return sprintf($this->futureText, $text);
    }

    public function withoutInterval(): self
    {
        $this->withInterval = false;

        return $this;
    }

    public function formatIntervalShort(bool $short = true): self
    {
        $this->formatIntervalShort = $short;

        return $this;
    }

    public function setTimezone($timezone): self
    {
        $this->timezone = $timezone;

        return $this;
    }

    public function setPastText(string $format): self
    {
        $this->pastText = $format;

        return $this;
    }

    public function setFutureText(string $format): self
    {
        $this->futureText = $format;

        return $this;
    }
}
