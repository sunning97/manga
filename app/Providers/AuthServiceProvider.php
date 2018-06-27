<?php

namespace App\Providers;

use App\Models\Permission;
use Illuminate\Support\Facades\Gate;
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
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        if(! $this->app->runningInConsole()) {
            $this->registerPolicies();

            foreach ($this->getPermission() as $permission) {
                Gate::define($permission->slug_name, function ($user) use ($permission) {
                    return $user->hasPermission($permission->slug_name);
                });
            }
        }
    }

    protected function getPermission(){
        return Permission::all();
    }
}
