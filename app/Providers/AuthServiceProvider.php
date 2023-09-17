<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Venue;
use App\Policies\UserPolicy;
use App\Policies\VenuePolicy;
use App\Constants\RolesConstant;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        User::class => UserPolicy::class,
        Venue::class => VenuePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define(
            'staffs.viewAny',
            function (User $user) {
                return $user->hasRole(RolesConstant::VENUE_MANAGERS);
            }
        );

        Gate::define(
            'staffs.create',
            function (User $user) {
                return $user->hasRole(RolesConstant::VENUE_MANAGERS);
            }
        );
    }
}
