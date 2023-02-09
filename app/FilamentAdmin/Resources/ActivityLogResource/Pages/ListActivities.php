<?php

namespace App\FilamentAdmin\Resources\ActivityLogResource\Pages;

use App\FilamentAdmin\Resources\ActivityLogResource;

class ListActivities extends \Z3d0X\FilamentLogger\Resources\ActivityResource\Pages\ListActivities
{
    /**
     * @return string
     */
    public static function getResource(): string
    {
        return ActivityLogResource::class;
    }
}
