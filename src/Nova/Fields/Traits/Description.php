<?php

declare(strict_types = 1);

namespace App\Nova\Fields\Traits;

use Tool\Str;
use Tool\StrStatic;
use Tool\Validation\Assert;
use function is_string;

/**
 * Trait DescriptionLong
 *
 * @mixin \Laravel\Nova\Fields\Text
 *
 * @property int $maxLength
 * @property int $showLimit
 */
trait Description
{
    public function __construct(string $name = 'Description', string $attribute = null, callable $resolveCallback = null)
    {
        parent::__construct($name, $attribute, $resolveCallback);

        $this->maxLength = $this->maxLength ?? 1024;
        $this->showLimit = $this->showLimit ?? 1024;

        $this->rules(['string', 'nullable'])
            ->sortable()
            ->displayUsing(function (?string $value) {

                $value = $value ?? '';

                if ($this->showLimit !== null) {
                    return StrStatic::abbr($value, $this->showLimit);
                }

                return $value;
            });
    }

    public function setShowLimit(int $length): self
    {
        $this->showLimit = $length;

        return $this;
    }

    public function clearShowLimit(): self
    {
        $this->showLimit = null;

        return $this;
    }

    public function setMaxLength(int $length): self
    {
        $this->maxLength = Assert::min($length, 1, 'The max length must be at least 1.');

        // Reset the rules with the new max length.
        return $this->rules($this->rules);
    }

    public function rules($rules)
    {
        parent::rules($rules);

        $rules = [];

        // Replace in rules.
        foreach ($this->rules as $index => $rule) {

            // Don't add max length rule.
            if (is_string($rule) && Str::make($rule)
                    ->trim()
                    ->toLowerCase()
                    ->startsWith('max:')) {

                continue;
            }

            $rules[] = $rule;
        }

        // Now add it.
        $this->rules[] = 'max:' . $this->maxLength;

        // Dont' need to re-set rules but the vendor code may change.
        parent::rules($rules);

        return $this;
    }
}
