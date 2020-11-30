<?php

declare(strict_types = 1);

namespace TCB\Laravel\Providers;

use App\Facades\Nova;
use App\Models\User\User;
use ChrisWare\NovaBreadcrumbs\NovaBreadcrumbs;
use Davidpiesse\NovaPhpinfo\Tool;
use Illuminate\Support\Facades\Gate;
use KABBOUCHI\LogsTool\LogsTool;
use Laravel\Nova\NovaApplicationServiceProvider;
use Sbine\RouteViewer\RouteViewer;
use Spatie\BackupTool\BackupTool;

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
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools(): array
    {
        return [
            new RouteViewer,
            new BackupTool,
            new Tool,
            new LogsTool,
            NovaBreadcrumbs::make(),
        ];
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
        Gate::define('viewNova', function (User $user): bool {

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
