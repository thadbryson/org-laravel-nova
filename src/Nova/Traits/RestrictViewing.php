<?php /** @noinspection PhpUnusedParameterInspection */

declare(strict_types = 1);

namespace TCB\Laravel\Nova\Traits;

use Illuminate\Http\Request;

trait RestrictViewing
{
    public function authorizedToView(Request $request)
    {
        return false;
    }
}
