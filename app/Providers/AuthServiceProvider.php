<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\Role;
use App\Models\User;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
        #FIXME
        Gate::define('role_deletable', function (User $user) {
            $forbiddenRoles = [Role::IS_ADMIN, Role::IS_PROFESSOR, Role::IS_STUDENT];

            // Verificar que ninguno de los roles prohibidos esté presente en los roles del usuario
            return !$user->roles->contains(function ($role) use ($forbiddenRoles) {
                return in_array($role->id, $forbiddenRoles);
            });
        });
    }
}
