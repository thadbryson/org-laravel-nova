<?php /** @noinspection PhpUnusedParameterInspection */

declare(strict_types = 1);

namespace TCB\Laravel\Nova\Resources\Traits;

use Illuminate\Http\Request;
use Laravel\Nova\Http\Requests\NovaRequest;

trait RestrictUpdates
{
    public static function authorizeToCreate(Request $request)
    {
        return false;
    }

    public static function authorizedToCreate(Request $request)
    {
        return false;
    }

    public function authorizeToUpdate(Request $request)
    {
        return false;
    }

    public function authorizedToUpdate(Request $request)
    {
        return false;
    }

    public function authorizedToAdd(NovaRequest $request, $model)
    {
        return false;
    }

    public function authorizedToAttachAny(NovaRequest $request, $model)
    {
        return false;
    }

    public function authorizedToAttach(NovaRequest $request, $model)
    {
        return false;
    }

    public function authorizedToDetach(NovaRequest $request, $model, $relationship)
    {
        return false;
    }
}
