<?php

namespace App\Providers;

use App\Models\Company;
use App\Models\ConnectedAccount;
use App\Models\Navigation;
use App\Policies\CompanyPolicy;
use App\Policies\ConnectedAccountPolicy;
use App\Policies\NavigationPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Company::class => CompanyPolicy::class,
        ConnectedAccount::class => ConnectedAccountPolicy::class,
        Navigation::class => NavigationPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     */
    public function boot(): void
    {
        $this->registerPolicies();

        //
    }
}
