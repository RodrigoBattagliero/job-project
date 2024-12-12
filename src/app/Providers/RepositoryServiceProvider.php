<?php

namespace App\Providers;

use App\Interfaces\JobOpportunityRepositoryInterface;
use App\Repositories\JobOpportunityRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(JobOpportunityRepositoryInterface::class, JobOpportunityRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
