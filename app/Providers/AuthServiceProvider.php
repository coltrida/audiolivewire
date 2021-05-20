<?php

namespace App\Providers;

use App\Models\Filiale;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use function dd;

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
        Gate::define('access-filiale', function(User $user, $idFiliale){
            //dd($user->filiale->contains('id', $idFiliale));
            return $user->filiale->contains('id', $idFiliale) || $user->isAdmin;
        });
        //
    }
}
