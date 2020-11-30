<?php

declare(strict_types = 1);

namespace TCB\Laravel\Nova\Fields;

use Laravel\Nova\Fields\Text;
use Tool\Collection;

/**
 * Class Icon
 *
 * Show icons for different values.
 */
class Icon extends Text
{
    /**
     * Values to their icons.
     *
     * @var Collection
     */
    protected $icons;

    /**
     * Default display if no values match.
     *
     * @var string
     */
    protected $default = '';

    public function __construct(string $name, string $attribute = null, callable $resolveCallback = null)
    {
        $this->icons = new Collection;

        parent::__construct($name, $attribute, $resolveCallback);

        $this->asHtml()
            ->exceptOnForms()
            ->withMeta(['textAlign' => 'center'])
            ->displayUsing(function ($value) {

                foreach ($this->icons as $test) {

                    if ($value === $test['value']) {
                        return sprintf('<span class="%s">%s</span>', $test['icon'], $test['text']);
                    }
                }

                // Nothing found.
                return $this->default;
            });
    }

    public function addIcon($value, string $icon = 'btn btn-bg btn-primary rounded p-2 text-white'): self
    {
        return $this->addTextIcon($value, '', $icon);
    }

    public function addTextIcon($value, string $text = null, string $icon = 'btn btn-bg btn-primary rounded p-2 text-white'): self
    {
        $text = $text ?? (string) $value;

        $this->icons = $this->icons
            ->reject(function (array $test) use ($value) {

                return $test['value'] === $value;
            })
            ->add([
                'value' => $value,
                'icon'  => $icon,
                'text'  => $text,
            ]);

        return $this;
    }

    public function setDefault(string $icon): self
    {
        $this->default = $icon;

        return $this;
    }
}
