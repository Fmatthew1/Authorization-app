<?php

namespace App\Providers;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Product;
use App\Policies\ProductPolicy;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        Gate::define('update-product', function (User $user, Product $product) {
            return $user->is_admin = 1;
        });

        Gate::policy(Product::class, ProductPolicy::class);
    //     $this->registerPolicies();

    //     Gate::define('admin-only', function (User $user) {
    //     return $user->hasRole('admin');
    // });

    //     Gate::define('user-only', function (User $user) {
    //     return $user->hasRole('user');
    // });

    }
}
