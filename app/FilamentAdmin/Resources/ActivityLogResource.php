<?php

namespace App\FilamentAdmin\Resources;

use App\FilamentAdmin\Resources\ActivityLogResource\Pages\ListActivities;
use App\FilamentAdmin\Resources\ActivityLogResource\Pages\ViewActivity;
use Artificertech\FilamentMultiContext\Concerns\ContextualResource;
use Filament\Resources\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Z3d0X\FilamentLogger\Resources\ActivityResource;

class ActivityLogResource extends ActivityResource
{
    use ContextualResource;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->withoutGlobalScope('company');
    }

    public static function getPages(): array
    {
        return [
            'index' => ListActivities::route('/'),
            'view' => ViewActivity::route('/{record}'),
        ];
    }

    public static function table(Table $table): Table
    {
        $parent = parent::table($table);
        $columns = $parent->getColumns();
        array_unshift($columns,
            TextColumn::make('company.name')
                ->translateLabel()
        );

        $filters = $parent->getFilters();
        array_unshift($filters,
            SelectFilter::make('company')
                ->relationship('company', 'name')
        );

        return $parent->columns($columns)->filters($filters);
    }
}
