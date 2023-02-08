<?php

namespace App\Filament\Resources\RoleResource\Pages;

use App\Filament\Resources\RoleResource;
use App\Models\Role;
use Filament\Notifications\Notification;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRole extends EditRecord
{
    protected static string $resource = RoleResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->before(function (Actions\DeleteAction $action) {
                    // keep at least one role
                    if (Role::query()->count() === 1) {
                        Notification::make()
                            ->danger()
                            ->title(__('Cannot delete role'))
                            ->body(__('You cannot delete the last role.'))
                            ->send();
                        $action->cancel();
                    }

                    // keep the role if it's assigned to a user
                    if ($action->getRecord()->company->users()->wherePivot('role', $action->getRecord()->key)->count() > 0) {
                        Notification::make()
                            ->danger()
                            ->title(__('Cannot delete role'))
                            ->body(__('You cannot delete a role that is assigned to a employee.'))
                            ->send();
                        $action->cancel();
                    }
                }),
        ];
    }
}
