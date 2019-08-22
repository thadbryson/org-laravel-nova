<?php

declare(strict_types = 1);

namespace TCB\Laravel\Nova;

use TCB\Laravel\Nova\Fields\EmailLink;
use TCB\Laravel\Nova\Fields\ID;
use TCB\Laravel\Nova\Fields\Name;
use TCB\Laravel\Nova\Resources\Traits\RestrictViewing;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\PasswordConfirmation;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Panel;

class User extends Resource
{
    use RestrictViewing;

    public static $model = \App\Models\User\User::class;

    public static $title = 'name';

    public static $search = [
        'name', 'email',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make(),

            new Panel('Details', [
                Name::make(),

                EmailLink::make(),
                Text::make('Email')
                    ->onlyOnForms()
                    ->creationRules('unique:users,email')
                    ->updateRules('unique:users,email,{{resourceId}}'),
            ]),

            new Panel('Change Password', [
                Password::make('Password')
                    ->onlyOnForms()
                    ->creationRules(['required', 'string', 'min:8'])
                    ->updateRules('nullable', 'string', 'min:8'),

                PasswordConfirmation::make('Password Confirmation', 'password_confirm')
                    ->onlyOnForms()
                    ->creationRules('required', 'string', 'min:8')
                    ->updateRules('nullable', 'string', 'min:8')
            ])
        ];
    }
}
