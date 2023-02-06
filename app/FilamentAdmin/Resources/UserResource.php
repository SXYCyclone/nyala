<?php

namespace App\FilamentAdmin\Resources;

use App\FilamentAdmin\Resources\UserResource\Pages;
use App\FilamentAdmin\Resources\UserResource\RelationManagers;
use App\Models\User;
use Artificertech\FilamentMultiContext\Concerns\ContextualResource;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class UserResource extends Resource
{
    use ContextualResource;

    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->translateLabel(),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255)
                    ->translateLabel(),
                Forms\Components\DateTimePicker::make('email_verified_at')
                    ->translateLabel(),
                Forms\Components\DateTimePicker::make('two_factor_confirmed_at')
                    ->translateLabel(),
                Forms\Components\FileUpload::make('profile_photo_path')
                    ->disk(config('filament-companies.profile_photo_disk'))
                    ->directory('profile-photos')
                    ->avatar()
                    ->label(__('Avatar')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->sortable(),
                Tables\Columns\ImageColumn::make('profile_photo_url')
                    ->circular()
                    ->label(__('Avatar')),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->translateLabel(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->sortable()
                    ->translateLabel(),
                Tables\Columns\IconColumn::make('email_verified_at')
                    ->options([
                        'heroicon-o-check-circle',
                        'heroicon-o-x-circle' => fn($state) => $state === null,
                    ])
                    ->colors([
                        'success',
                        'danger' => fn($state) => $state === null,
                    ])
                    ->label(__('Email Verified')),
                Tables\Columns\IconColumn::make('two_factor_confirmed_at')
                    ->options([
                        'heroicon-o-check-circle',
                        'heroicon-o-x-circle' => fn($state) => $state === null,
                    ])
                    ->colors([
                        'success',
                        'danger' => fn($state) => $state === null,
                    ])
                    ->label(__('2FA Confirmed')),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->translateLabel(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
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
            'index' => \App\FilamentAdmin\Resources\UserResource\Pages\ListUsers::route('/'),
            'create' => \App\FilamentAdmin\Resources\UserResource\Pages\CreateUser::route('/create'),
            'edit' => \App\FilamentAdmin\Resources\UserResource\Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
