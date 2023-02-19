<?php

namespace App\Listeners;

use Wallo\FilamentCompanies\Events\CompanyCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class InitRolesForNewCompany
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(CompanyCreated $event): void
    {
        // fetch initial roles from config
        $roles = config('nyala.role.initial');
        $presets = config('nyala.role.presets');

        foreach ($roles as $role) {
            $preset = $presets[$role];
            $event->company->roles()->create([
                'key' => $role,
                'name' => $preset['name'],
                'description' => $preset['description'],
                'permissions' => $preset['permissions'],
            ]);
        }
    }
}
