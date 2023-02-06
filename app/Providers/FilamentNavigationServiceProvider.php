<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Filament\Navigation\NavigationGroup;
use Filament\Navigation\NavigationItem;
use Illuminate\Support\ServiceProvider;
use RyanChandler\FilamentNavigation\Facades\FilamentNavigation;
use RyanChandler\FilamentNavigation\FilamentNavigationManager;

class FilamentNavigationServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Filament::serving(function () {
            $groups = [];
            $items = [];
            foreach (FilamentNavigation::get('sidebar')->items ?? [] as $item) {
                if ($item['children']) {
                    $groups[] = NavigationGroup::make()
                        ->label($item['label']);
                    foreach ($item['children'] as $child) {
                        $items[] = NavigationItem::make()
                            ->label($child['label'])
                            ->url($child['data']['url'], $child['data']['target'] === '_blank')
                            ->group($item['label'])
                            ->icon('heroicon-o-document-text');
                    }
                } else {
                    $items[] = NavigationItem::make()
                        ->label($item['label'])
                        ->url($item['data']['url'], $item['data']['target'] === '_blank')
                        ->icon('heroicon-o-document-text');
                }
            }

            FIlament::registerNavigationGroups($groups);
            Filament::registerNavigationItems($items);
        });
    }
}
