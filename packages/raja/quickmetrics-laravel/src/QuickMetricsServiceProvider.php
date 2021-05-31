<?php

namespace Raja\QuickMetrics;

use Illuminate\Support\ServiceProvider;

class QuickMetricsServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/quickmetrics.php' => config_path('quickmetrics.php')
        ]);
    }
    public function register()
    {
        $this->app->singleton(QuickMetrics::class, function () {
            return new QuickMetrics();
        });
    }
}
