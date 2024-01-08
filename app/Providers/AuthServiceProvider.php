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
        // Creamos una permision que no deje borrar los roles importantes
        Gate::define('role_deletable', function (User $user, $targetRoleId) {
            $forbiddenRoles = [Role::IS_ADMIN, Role::IS_PROFESSOR, Role::IS_STUDENT];

            // Verificar si el rol objetivo es uno de los roles prohibidos
            return !in_array($targetRoleId, $forbiddenRoles);
        });

    }
}
