<?php

namespace App\Providers;

use App\Policies\RoleServicePolicy;
use App\Policies\PermissionServicePolicy;
use App\Policies\UserServicePolicy;
use App\Services\RoleService;
use App\Services\PermissionService;
use App\Services\UserNotificationService;
use App\Services\UserService;
use Illuminate\Support\Facades\Gate;
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
        UserService::class => UserServicePolicy::class,
        UserNotificationService::class => UserNotificationServicePolicy::class,
        NotificationService::class => NotificationServicePolicy::class,
        FileService::class => FileServicePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::before(function ($user, $ability) {
            if ($user->hasRole('admin')) {
                return true;
            }
        });

        Passport::routes(function ($router) {
            $router->forAccessTokens();
            $router->forTransientTokens();
        });

        Passport::tokensExpireIn(now()->addMinute(10));

        Passport::refreshTokensExpireIn(now()->addDays(10));
    }
}
