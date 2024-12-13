<?php

namespace App\Providers;

use App\Services\Search\AvatureSource;
use Illuminate\Support\ServiceProvider;
use App\Services\Search\ExternalSourceInterface;

class SearchExternalServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ExternalSourceInterface::class, AvatureSource::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
