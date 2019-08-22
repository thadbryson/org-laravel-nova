<?php

declare(strict_types = 1);

namespace App\Nova\Fields\Boolean;

use App\Nova\Fields\Icon;
use Tool\Cast;
use Tool\Str;

/**
 * Class Display
 *
 * Display Boolean field icon.
 *
 * @method static Display make(...$arguments)
 */
class Display extends Icon
{
    public function __construct(string $name, string $attribute = null, callable $resolveCallback = null)
    {
        $attribute = Str::make($attribute ?? $name)
            ->trim(' ?')
            ->replace(' ', '_')
            ->toLowerCase()
            ->get();

        parent::__construct($name, $attribute, $resolveCallback ?? function ($value) {

                return Cast::toBoolean($value);
            });

        $this->addTextIcon(true, 'Yes')
            ->withMeta(['textAlign' => 'center']);
    }

    public function trueText(string $text, string $icon = 'btn btn-bg btn-primary rounded p-2 text-white'): self
    {
        $this->addTextIcon(true, $text, $icon);

        return $this;
    }

    public function falseText(string $text, string $icon = 'btn btn-bg btn-danger rounded p-2 text-white'): self
    {
        $this->addTextIcon(false, $text, $icon);

        return $this;
    }
}
