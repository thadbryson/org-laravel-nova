<?php

declare(strict_types = 1);

namespace TCB\Laravel\Nova;

use App\Facades\Nova;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\NovaApplicationServiceProvider;

abstract class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Limit Nova admin to only User with this e-mail address?
     * If NULL there is no restriction.
     *
     * @var string|null
     */
    protected $whitelistEmail;

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        parent::boot();

        Nova::provideToScript(['version' => Nova::version()]);
    }

    /**
     * Register the application's Nova resources.
     *
     * @return void
     */
    protected function resources(): void
    {
        Nova::resourcesIn(app_path('Nova'));
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools(): array
    {
        return [
            new \Sbine\RouteViewer\RouteViewer,
            new \Spatie\BackupTool\BackupTool,
            new \Davidpiesse\NovaPhpinfo\Tool,
            new \KABBOUCHI\LogsTool\LogsTool,
            \ChrisWare\NovaBreadcrumbs\NovaBreadcrumbs::make(),
        ];
    }

    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes(): void
    {
        Nova::routes()
            ->withAuthenticationRoutes()
            ->withPasswordResetRoutes()
            ->register();
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate(): void
    {
        Gate::define('viewNova', function (\App\Models\User\User $user): bool {

            if ($this->whitelistEmail === null) {
                return true;
            }

            return $user->email === $this->whitelistEmail;
        });
    }

    /**
     * Get the cards that should be displayed on the Nova dashboard.
     *
     * @return array
     */
    protected function cards(): array
    {
        return [];
    }
}
