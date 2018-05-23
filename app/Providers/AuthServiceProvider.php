<?php

namespace App\Providers;

use App\Policies\RoleServicePolicy;
use App\Policies\PermissionServicePolicy;
use App\Policies\UserServicePolicy;
use App\Services\RoleService;
use App\Services\PermissionService;
use App\Services\UserService;
use Laravel\Passport\Passport;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        RoleService::class => RoleServicePolicy::class,
        PermissionService::class => PermissionServicePolicy::class,
        UserService::class => UserServicePolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
        Passport::routes(function ($router) {
            $router->forAccessTokens();
            $router->forTransientTokens();
        });

        Passport::tokensExpireIn(now()->addMinute(10));

        Passport::refreshTokensExpireIn(now()->addDays(10));
    }
}
