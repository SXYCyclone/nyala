<?php

namespace App\FilamentAdmin\Resources\ActivityLogResource\Pages;

use App\FilamentAdmin\Resources\ActivityLogResource;

class ViewActivity extends \Z3d0X\FilamentLogger\Resources\ActivityResource\Pages\ViewActivity
{
    /**
     * @return string
     */
    public static function getResource(): string
    {
        return ActivityLogResource::class;
    }
}
