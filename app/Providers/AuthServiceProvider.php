<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('create-account', function (){
            error_log("Walidacja uprawnień: tworzenie konta");
            return !(Auth::user()->isParent());
        });

        Gate::define('create-kid', function (){
            error_log("Walidacja uprawnień: dodawanie dziecka");
            return Auth::user()->isParent();
        });
    }
}
