<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes();

        /* define whether Licence purchased by Institute */
        Gate::define('isLicencePurchased', function($health_institution) {
            return $health_institution->license_subscription()->exists();
        });

        /* define a Country Head role */
        Gate::define('isCountryHead', function($health_institution) {
            return $health_institution->isHead == 1;
        });
    }
}
