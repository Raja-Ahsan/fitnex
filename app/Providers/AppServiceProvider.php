<?php

namespace App\Providers;
use View;
use App\Models\User;
use App\Observers\TrainerObserver;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
		/* $testimonails = testimonials();
        view::share('testimonails', $testimonails); */
        $home_page_data = globalData();
        View::share('home_page_data', $home_page_data);
        $game_category_data = gamecategorydata();
        View::share('game_category_data', $game_category_data);

        View::composer('layouts.admin.header', function ($view) {
            if (Auth::check()) {
                $view->with('notifications', Auth::user()->unreadNotifications);
            } else {
                $view->with('notifications', collect()); // empty collection if not logged in
            }
        });

        // Register TrainerObserver to sync trainers from users
        User::observe(TrainerObserver::class);
    }
}
