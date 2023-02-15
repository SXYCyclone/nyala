<?php

namespace App\Enums;

enum GameServerProtocol: string
{
    case SOURCE_RCON = 'source-rcon';
    case GAMESPY4 = 'gamespy4';
    case MINECRAFT_PING = 'minecraft-ping';
}
