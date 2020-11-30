<?php

declare(strict_types = 1);

namespace TCB\Laravel\Nova\Actions;

use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;

class SetValue extends Action
{
    use InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Title to display on frontend.
     *
     * @var string
     */
    public $name;

    protected $attribute;

    protected $value;

    public function __construct(string $attribute, $value, string $name)
    {
        $this->attribute = $attribute;
        $this->value     = $value;
        $this->name      = $name;
    }

    /**
     * Perform the action on the given models.
     *
     * @param ActionFields $fields
     * @param Collection   $models
     * @return array
     * @throws Exception
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
