<?php

namespace App\Filament\Resources\GameServerResource\Pages;

use App\Filament\Resources\GameServerResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGameServer extends EditRecord
{
    protected static string $resource = GameServerResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
