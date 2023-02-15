<?php

namespace App\Filament\Resources\GameServerResource\Pages;

use App\Filament\Resources\GameServerResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGameServers extends ListRecords
{
    protected static string $resource = GameServerResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
