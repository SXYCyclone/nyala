<?php

namespace App\Providers;

use Artificertech\FilamentMultiContext\ContextServiceProvider;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\View;

class FilamentAdminServiceProvider extends ContextServiceProvider
{
    public static string $name = 'filament-admin';

    public function bootingPackage()
    {
        parent::bootingPackage();

        Filament::registerRenderHook('global-search.start', fn() => View::make('filament-environment-indicator::badge', [
            'color' => '#DC0504',
            'environment' => 'Admin',
        ]));
    }
}
