<?php

namespace App\Filament\Resources;

use App\Enums\GameServerProtocol;
use App\Enums\GameServerType;
use App\Filament\Resources\GameServerResource\Pages;
use App\Filament\Resources\GameServerResource\RelationManagers;
use App\Models\GameServer;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class GameServerResource extends Resource
{
    protected static ?string $model = GameServer::class;

    protected static ?string $navigationIcon = 'heroicon-o-server';

    public static function form(Form $form): Form
    {
        $types = collect(GameServerType::cases())->mapWithKeys(fn($type) => [$type->value => $type->name]);

        $protocols = collect(GameServerProtocol::cases())->mapWithKeys(fn($protocol) => [$protocol->value => $protocol->name]);

        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->translateLabel(),
                Forms\Components\Select::make('type')
                    ->options($types)
                    ->required()
                    ->translateLabel(),
                Forms\Components\Select::make('protocol')
                    ->options($protocols)
                    ->required()
                    ->translateLabel(),
                Forms\Components\TextInput::make('config')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('type'),
                Tables\Columns\TextColumn::make('protocol'),
                Tables\Columns\TextColumn::make('config'),
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
            'index' => Pages\ListGameServers::route('/'),
            'create' => Pages\CreateGameServer::route('/create'),
            'edit' => Pages\EditGameServer::route('/{record}/edit'),
        ];
    }
}
