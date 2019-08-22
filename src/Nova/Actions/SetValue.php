<?php

declare(strict_types = 1);

namespace TCB\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;

class SetValue extends \Laravel\Nova\Actions\Action
{
    use InteractsWithQueue, Queueable, SerializesModels;

    protected $attribute;

    protected $value;

    /**
     * Title to display on frontend.
     *
     * @var string
     */
    public $name;

    public function __construct(string $attribute, $value, string $name)
    {
        $this->attribute = $attribute;
        $this->value     = $value;
        $this->name      = $name;
    }

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields $fields
     * @param  \Illuminate\Support\Collection    $models
     * @return array
     * @throws \Exception
     */
    public function handle(ActionFields $fields, Collection $models): array
    {
        $model = $models->first();

        if ($model === null) {
            return Action::danger('Nothing was selected for updating.');
        }

        foreach ($models as $model) {
            $model->{$this->attribute} = $this->value;
            $model->save();
        }

        return Action::message('Success');
    }
}
