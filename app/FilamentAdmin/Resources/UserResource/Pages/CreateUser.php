<?php

namespace App\FilamentAdmin\Resources\UserResource\Pages;

use App\FilamentAdmin\Resources\UserResource;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;
}
