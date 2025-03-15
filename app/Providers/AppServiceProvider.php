<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Post;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Gate::define('create-post',function(User $user){
            return $user->type == 'writer';
        });

        Gate::define('admin-controlle',function(User $user){
            return $user->type == "admin";

        });
        Gate::define('edit-post',function(User $user , Post $post){
            return $user->type == 'admin' || $user->id == $post->userID;
        });
        
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
        
    }
}
