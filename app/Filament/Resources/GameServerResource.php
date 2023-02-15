<?php

namespace App\Filament\Resources;

use App\Enums\GameServerProtocol;
use App\Enums\GameServerType;
use App\Filament\Resources\GameServerResource\Pages;
use App\Filament\Resources\GameServerResource\RelationManagers;
use App\Forms\Components\RichSelect;
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
        $types = collect(GameServerType::cases())->mapWithKeys(fn($type) => [$type->value => $type->getName()]);
        $types_descriptions = collect(GameServerType::cases())->mapWithKeys(fn($type) => [$type->value => $type->getDescription()]);

        $protocols = collect(GameServerProtocol::cases())->mapWithKeys(fn($protocol) => [$protocol->value => $protocol->name]);
        $protocols_descriptions = collect(GameServerProtocol::cases())->mapWithKeys(fn($protocol) => [$protocol->value => $protocol->getDescription()]);

        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->translateLabel(),
                RichSelect::make('type')
                    ->options($types)
                    ->descriptions($types_descriptions)
                    ->required()
                    ->translateLabel(),
                RichSelect::make('protocol')
                    ->options($protocols)
                    ->descriptions($protocols_descriptions)
                    ->required()
                    ->translateLabel(),
                Forms\Components\KeyValue::make('config')
                    ->required()
                    ->translateLabel(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->translateLabel(),
                Tables\Columns\TextColumn::make('type')
                    ->enum(collect(GameServerType::cases())->mapWithKeys(fn($type) => [$type->value => $type->getName()]))
                    ->translateLabel(),
                Tables\Columns\TextColumn::make('protocol')
                    ->enum(collect(GameServerProtocol::cases())->mapWithKeys(fn($type) => [$type->value => $type->getName()]))
                    ->translateLabel(),
                Tables\Columns\TextColumn::make('config')
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
            'index' => Pages\ListGameServers::route('/'),
            'create' => Pages\CreateGameServer::route('/create'),
            'edit' => Pages\EditGameServer::route('/{record}/edit'),
        ];
    }
}
