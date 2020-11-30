<?php

declare(strict_types = 1);

namespace TCB\Laravel;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../config/app_data.php'  => config_path('app_data.php'),
            __DIR__ . '/../docker'               => base_path('docker'),
            __DIR__ . '/../resources/js/publish' => resource_path('js'),
            __DIR__ . '/../resources/js/shared'  => resource_path('js/vendor/nova-tcb'),
            __DIR__ . '/../resources/lang/en'    => resource_path('lang/en'),
            __DIR__ . '/../resources/sass'       => resource_path('sass'),
        ]);
    }
}
