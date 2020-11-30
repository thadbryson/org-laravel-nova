<?php

declare(strict_types = 1);

namespace TCB\Laravel\Nova\Fields;

use Laravel\Nova\Fields\Text;

class Link extends Text
{
    protected $text = 'Link';

    protected $classes = '';

    protected $target = '';

    protected $textUseValue = false;

    protected $format = '<a class="%s" href="%s" %s>%s</a>';

    public function __construct(string $name, string $attribute = null, callable $resolveCallback = null)
    {
        parent::__construct($name, $attribute, $resolveCallback);

        $this->asHtml()
            ->openNewTab()
            ->exceptOnForms()
            ->setClasses('no-underline dim text-primary font-bold')
            ->displayUsing(function ($value) {

                if (is_string($value)) {

                    $text = $this->text;

                    if ($this->textUseValue) {
                        $text = $value;
                    }

                    return sprintf($this->format, $this->classes, $value, $this->target, $text);
                }

                return '';
            });
    }

    public function setClasses(string $classes): self
    {
        $this->classes = $classes;

        return $this;
    }

    public function openNewTab(): self
    {
        $this->target = 'target="_blank"';

        return $this;
    }

    public function useTextAsValue(): self
    {
        $this->textUseValue = true;

        return $this;
    }

    public function setText(string $text): self
    {
        $this->textUseValue = false;

        $this->text = $text;

        return $this;
    }

    public function openSameTab(): self
    {
        $this->target = '';

        return $this;
    }
}
