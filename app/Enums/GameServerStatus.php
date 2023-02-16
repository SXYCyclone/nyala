<?php

namespace App\Enums;

enum GameServerStatus: string
{
    case OFFLINE = 'offline';
    case ONLINE = 'online';
    case STARTING = 'starting';
    case STOPPING = 'stopping';
    case RESTARTING = 'restarting';
    case UPDATING = 'updating';

    public function getName(): string
    {
        return __("nyala.game-server-status.{$this->value}.name");
    }

    public function getDescription(): string
    {
        return __("nyala.game-server-status.{$this->value}.description");
    }

    public function getIcon(): string
    {
        return __("nyala.game-server-status.{$this->value}.icon");
    }

    public function getColor(): string
    {
        return __("nyala.game-server-status.{$this->value}.color");
    }
}
