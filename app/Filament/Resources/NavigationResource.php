<?php

namespace App\Filament\Resources;

use Closure;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\View;
use Filament\Forms\Components\ViewField;
use Filament\Resources\Form;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;
use RyanChandler\FilamentNavigation\Models\Navigation;

class NavigationResource extends \RyanChandler\FilamentNavigation\Filament\Resources\NavigationResource
{
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make([
                    Select::make('name')
                        ->label(__('filament-navigation::filament-navigation.attributes.name'))
                        ->reactive()
                        ->afterStateUpdated(function (?string $state, Closure $set) {
                            if (!$state) {
                                return;
                            }

                            $set('handle', Str::slug($state));
                        })
                        ->required()
                        ->options(config('filament-navigation.suggested_handles')),
                    ViewField::make('items')
                        ->label(__('filament-navigation::filament-navigation.attributes.items'))
                        ->default([])
                        ->view('filament-navigation::navigation-builder'),
                ])
                    ->columnSpan([
                        12,
                        'lg' => 8,
                    ]),
                Group::make([
                    Card::make([
                        TextInput::make('handle')
                            ->label(__('filament-navigation::filament-navigation.attributes.handle'))
                            ->required()
                            ->unique(column: 'handle', ignoreRecord: true),
                        View::make('filament-navigation::card-divider')
                            ->visible(static::$showTimestamps),
                        Placeholder::make('created_at')
                            ->label(__('filament-navigation::filament-navigation.attributes.created_at'))
                            ->visible(static::$showTimestamps)
                            ->content(fn(?Navigation $record) => $record ? $record->created_at->translatedFormat(config('tables.date_time_format')) : new HtmlString('&mdash;')),
                        Placeholder::make('updated_at')
                            ->label(__('filament-navigation::filament-navigation.attributes.updated_at'))
                            ->visible(static::$showTimestamps)
                            ->content(fn(?Navigation $record) => $record ? $record->updated_at->translatedFormat(config('tables.date_time_format')) : new HtmlString('&mdash;')),
                    ]),
                ])
                    ->columnSpan([
                        12,
                        'lg' => 4,
                    ]),
            ])
            ->columns(12);
    }
}
