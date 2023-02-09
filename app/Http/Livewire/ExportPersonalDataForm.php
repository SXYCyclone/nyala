<?php

namespace App\Http\Livewire;

use Filament\Notifications\Notification;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Spatie\PersonalDataExport\Jobs\CreatePersonalDataExportJob;

class ExportPersonalDataForm extends Component
{
    public $confirmingPersonalDataExport = false;

    public $password = '';

    public function confirmPersonalDataExport()
    {
        $this->resetErrorBag();

        $this->password = '';

        $this->dispatchBrowserEvent('confirming-export-personal-data');

        $this->confirmingPersonalDataExport = true;
    }

    public function exportPersonalData(): void
    {
        $this->resetErrorBag();

        if (!Hash::check($this->password, Auth::user()->password)) {
            throw ValidationException::withMessages([
                'password' => [__('This password does not match our records.')],
            ]);
        }

        dispatch(new CreatePersonalDataExportJob(Auth::user()));

        $this->confirmingPersonalDataExport = false;

        Notification::make()
            ->success()
            ->title(__('nyala.profile.export_personal_data.modal_title'))
            ->body(__('nyala.profile.export_personal_data.queueing'))
            ->persistent()
            ->send();
    }

    public function render()
    {
        return view('livewire.export-personal-data-form');
    }
}
