<?php

namespace App\Providers;

use Illuminate\Support\Facades\Artisan;
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
        // Auto-create storage symlink on boot (needed for Laravel Cloud / ephemeral filesystems)
        $storageLinkPath = public_path('storage');
        if (!file_exists($storageLinkPath) && !is_link($storageLinkPath)) {
            try {
                Artisan::call('storage:link');
            } catch (\Exception $e) {
                // Silently fail if storage:link can't be created
            }
        }

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
