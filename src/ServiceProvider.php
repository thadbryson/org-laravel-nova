<?php

declare(strict_types = 1);

namespace TCB\Laravel;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    protected $id = 'tcb-nova';

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', $this->id);
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', $this->id);

        $this->publishes([
            __DIR__ . '/../resources/lang'  => resource_path('lang/vendor/' . $this->id),
            __DIR__ . '/../resources/views' => resource_path('views/vendor/' . $this->id),
            __DIR__ . '/../config/app_data', 'app_data'
        ]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        //
    }
}