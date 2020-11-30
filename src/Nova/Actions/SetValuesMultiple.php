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

class SetValuesMultiple extends Action
{
    use InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Title to display on frontend.
     *
     * @var string
     */
    public $name;

    /**
     * @var array
     */
    protected $values;

    public function __construct(array $values, string $name)
    {
        $this->values = $values;
        $this->name   = $name;
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
            $model->forceFill($this->values);
            $model->save();
        }

        return Action::message('Success');
    }
}
