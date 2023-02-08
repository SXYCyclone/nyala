<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RoleResource\Pages;
use App\Filament\Resources\RoleResource\RelationManagers;
use App\Models\Role;
use Closure;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RoleResource extends Resource
{
    protected static ?string $model = Role::class;

    protected static ?string $navigationIcon = 'heroicon-o-shield-check';

    public static function form(Form $form): Form
    {
        // Transform the presets config into an array of preset name, but preserve the key
        $presets = collect(config('nyala.role.presets'))
            ->mapWithKeys(fn($preset, $key) => [$key => $preset['name']])
            ->toArray();

        return $form
            ->schema([
                Forms\Components\TextInput::make('key')
                    ->required()
                    ->maxLength(255)
                    ->translateLabel(),
                Forms\Components\Select::make('preset')
                    ->searchable()
                    ->options($presets)
                    ->default('custom')
                    ->reactive()
                    ->afterStateUpdated(function (?string $state, Closure $set) {
                        if (!$state) {
                            return;
                        }

                        $preset = config('nyala.role.presets')[$state];
                        $set('key', $state);
                        $set('name', $preset['name']);
                        $set('description', $preset['description']);
                        $set('permissions', $preset['permissions']);
                    })
                    ->translateLabel(),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('description')
                    ->nullable()
                    ->maxLength(255),
                Forms\Components\CheckboxList::make('permissions')
                    ->options(
                        collect(config('nyala.role.permissions'))
                            ->mapWithKeys(fn($permission, $key) => [$key => "$key - $permission"])
                            ->toArray()
                    )
                    ->translateLabel(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('key'),
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('description'),
                Tables\Columns\TagsColumn::make('permissions'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                //
            ])
            ->reorderable('level');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRoles::route('/'),
            'create' => Pages\CreateRole::route('/create'),
            'edit' => Pages\EditRole::route('/{record}/edit'),
        ];
    }
}
