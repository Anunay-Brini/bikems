<?php

namespace App\Providers;

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
        try {
            if (\Illuminate\Support\Facades\Schema::hasTable('users')) {
                \App\Models\User::firstOrCreate(
                    ['email' => 'admin@bikems.com'],
                    [
                        'name' => 'Admin',
                        'password' => \Illuminate\Support\Facades\Hash::make('password123'),
                        'role' => 'admin',
                    ]
                );
            }
        } catch (\Exception $e) {
            // Ignore exception if the database is not yet ready or migrating
        }
    }
}
