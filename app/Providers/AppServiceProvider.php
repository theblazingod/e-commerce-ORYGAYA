<?php

namespace App\Providers;

use App\Modules\ModuleManager;
use App\Modules\ModuleServiceProvider;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Livewire\Livewire;
use App\Http\Livewire\CartCount;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Register the module manager as a singleton
        $this->app->singleton(ModuleManager::class, function ($app) {
            return new ModuleManager();
        });

        // Register the module service provider
        $this->app->register(ModuleServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        app()->setLocale('id');
        
        Livewire::component('cart-count', CartCount::class);
        Blade::component('app-layout', \App\View\Components\AppLayout::class);
        Blade::component('guest-layout', \App\View\Components\GuestLayout::class);
        Livewire::component('profile.update-profile-information-form', \Laravel\Jetstream\Http\Livewire\UpdateProfileInformationForm::class);
        Livewire::component('profile.update-password-form', \Laravel\Jetstream\Http\Livewire\UpdatePasswordForm::class);
        Livewire::component('profile.two-factor-authentication-form', \Laravel\Jetstream\Http\Livewire\TwoFactorAuthenticationForm::class);
        Livewire::component('profile.logout-other-browser-sessions-form', \Laravel\Jetstream\Http\Livewire\LogoutOtherBrowserSessionsForm::class);
        Livewire::component('profile.delete-user-form', \Laravel\Jetstream\Http\Livewire\DeleteUserForm::class);

    }
}
