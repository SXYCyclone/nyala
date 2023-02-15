<?php

namespace App\Enums;

enum GameServerType: string
{
    case MINECRAFT = 'minecraft';
    case MINECRAFT_BEDROCK = 'minecraft-bedrock';

    public function getName(): string
    {
        return __("nyala.game-server-type.{$this->value}.name");
    }

    public function getDescription(): string
    {
        return __("nyala.game-server-type.{$this->value}.description");
    }
}
