<?php

declare(strict_types = 1);

namespace TCB\Laravel\Nova;

use Carbon\CarbonInterval;
use ChrisWare\NovaBreadcrumbs\Traits\Breadcrumbs;
use DateTime;
use DateTimeInterface;
use Tool\Clock;

/**
 * Abstract Class Resource
 *
 * @property @static string|null $label
 */
abstract class Resource extends \Laravel\Nova\Resource
{
    use Breadcrumbs;

    /**
     * Default 'name' attribute for relationship of this Resource.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * Default 'name' attribute for relationships of this Resource - subtitle.
     *
     * @var string|null
     */
    public static $subtitle;

    /**
     * Label for this Resource. Used in ::label()
     *
     * @var string|null
     */
    protected static $label;

    /**
     * Singular label for this Resource. used in ::singularLabel()
     *
     * @var string|null
     */
    protected static $singularLabel;

    /**
     * URI key for this Resource. Used in ::uriKey()
     *
     * @var string|null
     */
    protected static $uriKey;

    protected static $formatDateTime = 'D M j, Y g:ia';

    protected static $formatDate = 'D M j, Y';

    protected static $formatIcon = 'btn btn-bg btn-primary rounded p-2 text-white';

    public static $sort = [
        'id' => 'desc'
    ];

    /**
     * Returns TRUE - all Users can run.
     *
     * @var \Closure
     */
    protected $runByAll;

    public function __construct(\Illuminate\Database\Eloquent\Model $resource)
    {
        parent::__construct($resource);

        $this->runByAll = function () {
            return true;
        };
    }

    protected static function applyOrderings($query, array $orderings)
    {
        if ($orderings === []) {
            $orderings = static::$sort;
        }

        return parent::applyOrderings($query, $orderings);
    }

    public static function label(): string
    {
        return static::$label ?? parent::label();
    }

    public static function singularLabel(): string
    {
        return static::$singularLabel ?? parent::singularLabel();
    }

    public function subtitle(): ?string
    {
        return $this->{static::$subtitle} ?? null;
    }

    public static function uriKey(): string
    {
        return static::$uriKey ?? parent::uriKey();
    }

    protected function formatDate($value): string
    {
        $value = Clock::makeOrNull($value);

        if ($value === null) {
            return '';
        }

        return $value->format(static::$formatDate);
    }

    protected function formatDateTime($value): string
    {
        $value = Clock::makeOrNull($value);

        if ($value === null) {
            return '';
        }

        return $value->format(static::$formatDateTime);
    }

    protected function getInterval(DateTimeInterface $start, DateTimeInterface $from = null): CarbonInterval
    {
        $from  = Clock::make($from ?? new DateTime);
        $start = Clock::make($start);

        return $start->diffAsCarbonInterval($from);
    }

    protected function formatInterval(DateTimeInterface $start, DateTimeInterface $from = null): string
    {
        return $this->getInterval($start, $from)
            ->seconds(0)
            ->forHumans(true);
    }

    protected function formatIcon(string $text = '', string $icon = null): string
    {
        $icon = $icon ?? static::$formatIcon;

        return sprintf('<span class="%s">%s</span>', $icon, $text);
    }

    protected function formatLink(string $href, string $text, array $attributes = []): string
    {
        $attrs = '';

        foreach ($attributes as $name => $value) {
            $attrs .= sprintf(' %s="%s" ', $name, (string) $value);
        }

        return sprintf('<a class="no-underline dim text-primary font-bold" href="%s" %s>%s</a>', $href, $attrs, $text);
    }

    protected function formatLinkNewTab(string $href, string $text, array $attributes = []): string
    {
        $attributes['target'] = '_blank';

        return $this->formatLink($href, $text, $attributes);
    }
}
