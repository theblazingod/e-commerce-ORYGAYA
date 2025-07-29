<?php

namespace App\Providers\Filament;

use Filament\Facades\Filament;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages as FilamentPage;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        $panel
            ->default()
            ->id('admin')
            ->path('admin')

            // ->login([AuthenticatedSessionController::class, 'create'])
            // ->passwordReset()
            // ->emailVerification()
            ->viteTheme('resources/css/filament/admin/theme.css')
            ->colors([
                'primary' => Color::Gray,
                       ])
            ->resources([
                \App\Filament\Admin\Resources\OrderResource::class,
                \App\Filament\Admin\Resources\ProductCategoryResource::class,
                \App\Filament\Admin\Resources\ProductResource::class,
                \App\Filament\Admin\Resources\UserResource::class,
            ])
            ->discoverPages(in: app_path('Filament/Admin/Pages'), for: 'App\\Filament\\Admin\\Pages')
            ->discoverWidgets(in: app_path('Filament/Admin/Widgets/Home'), for: 'App\\Filament\\Admin\\Widgets\\Home')
            ->pages([
                FilamentPage\Dashboard::class,

                // Pages\ApiTokenManagerPage::class,
            ])->widgets([
                Widgets\AccountWidget::class,
                \App\Filament\Admin\Widgets\Home\CombinedWidgets::class,
                \App\Filament\Admin\Widgets\Home\MostPurchasedProducts::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
                
            ])
            ->navigationGroups([
                \Filament\Navigation\NavigationGroup::make()
                    ->label(fn (): string => __('general.Shop Management'))
            ])
            ->plugins([
                //\BezhanSalleh\FilamentShield\FilamentShieldPlugin::make()
            ]);

        $panel->brandName('ORYGAYA');

        // if (Features::hasApiFeatures()) {
        //     $panel->userMenuItems([
        //         MenuItem::make()
        //             ->label('API Tokens')
        //             ->icon('heroicon-o-key')
        //             ->url(fn () => $this->shouldRegisterMenuItem()
        //                 ? url(Pages\ApiTokenManagerPage::getUrl())
        //                 : url($panel->getPath())),
        //     ]);
        // }

        

        return $panel;
    }

    public function boot()
    {
       
    }

    public function shouldRegisterMenuItem(): bool
    {
        return true; //\Illuminate\Support\Facades\Auth::user()?->hasVerifiedEmail() && Filament::hasTenancy() && Filament::getTenant();
    }
}
