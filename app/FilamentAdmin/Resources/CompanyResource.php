<?php

namespace App\FilamentAdmin\Resources;

use App\FilamentAdmin\Resources\CompanyResource\Pages;
use App\FilamentAdmin\Resources\CompanyResource\RelationManagers;
use App\Models\Company;
use Artificertech\FilamentMultiContext\Concerns\ContextualResource;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class CompanyResource extends Resource
{
    use ContextualResource;

    protected static ?string $model = Company::class;

    protected static ?string $navigationIcon = 'heroicon-o-office-building';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('user_id')
                    ->required(),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Toggle::make('personal_company')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user_id'),
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\IconColumn::make('personal_company')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime(),
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
            'index' => \App\FilamentAdmin\Resources\CompanyResource\Pages\ListCompanies::route('/'),
            'create' => \App\FilamentAdmin\Resources\CompanyResource\Pages\CreateCompany::route('/create'),
            'edit' => \App\FilamentAdmin\Resources\CompanyResource\Pages\EditCompany::route('/{record}/edit'),
        ];
    }
}
