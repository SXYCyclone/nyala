<?php

namespace App\Enums;

enum GameServerProtocol: string
{
    case SOURCE_RCON = 'source-rcon';
    case GAMESPY4 = 'gamespy4';
    case MINECRAFT_PING = 'minecraft-ping';

    public function getName(): string
    {
        return __("nyala.game-server-protocol.{$this->value}.name");
    }

    public function getDescription(): string
    {
        return __("nyala.game-server-protocol.{$this->value}.description");
    }
}
