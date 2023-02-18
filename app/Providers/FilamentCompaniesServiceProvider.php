<?php

namespace App\Providers;

use App\Actions\FilamentCompanies\AddCompanyEmployee;
use App\Actions\FilamentCompanies\CreateCompany;
use App\Actions\FilamentCompanies\CreateConnectedAccount;
use App\Actions\FilamentCompanies\CreateUserFromProvider;
use App\Actions\FilamentCompanies\DeleteCompany;
use App\Actions\FilamentCompanies\DeleteUser;
use App\Actions\FilamentCompanies\HandleInvalidState;
use App\Actions\FilamentCompanies\InviteCompanyEmployee;
use App\Actions\FilamentCompanies\RemoveCompanyEmployee;
use App\Actions\FilamentCompanies\ResolveSocialiteUser;
use App\Actions\FilamentCompanies\SetUserPassword;
use App\Actions\FilamentCompanies\UpdateCompanyName;
use App\Actions\FilamentCompanies\UpdateConnectedAccount;
use App\Filament\Pages\User\Profile;
use App\Models\Role;
use Illuminate\Support\ServiceProvider;
use Wallo\FilamentCompanies\FilamentCompanies;
use Filament\Facades\Filament;
use Illuminate\Contracts\View\View;
use Filament\Navigation\UserMenuItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Blade;
use Wallo\FilamentCompanies\Actions\GenerateRedirectForProvider;
use Wallo\FilamentCompanies\Pages\User\APITokens;
use Wallo\FilamentCompanies\Socialite;

class FilamentCompaniesServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     */
    public function boot(): void
    {

        if (FilamentCompanies::hasCompanyFeatures()) {
            Filament::registerRenderHook(
                'global-search.start',
                fn(): View => view('filament-companies::components.dropdown.navigation-menu'),
            );
        }

        Filament::serving(function () {
            Filament::registerUserMenuItems([
                'account' => UserMenuItem::make()->url(Profile::getUrl()),
            ]);

            if (Filament::currentContext() === 'filament') {
                Filament::registerUserMenuItems([
                    'switch-to-admin' => UserMenuItem::make()
                        ->label('Switch to Admin')
                        ->icon('heroicon-s-chevron-double-up')
                        ->url('/' . config('filament-admin.path')),
                ]);
            } else {
                Filament::registerUserMenuItems([
                    'switch-to-company' => UserMenuItem::make()
                        ->label('Switch to company')
                        ->icon('heroicon-s-chevron-double-down')
                        ->url('/' . config('filament.path')),
                ]);
            }
        });

        if (FilamentCompanies::hasApiFeatures()) {
            Filament::serving(function () {
                Filament::registerUserMenuItems([
                    UserMenuItem::make()
                        ->label('API Tokens')
                        ->icon('heroicon-s-lock-open')
                        ->url(APITokens::getUrl()),
                ]);
            });
        }

        Filament::serving(function () {
            Filament::registerUserMenuItems([
                'logout' => UserMenuItem::make()->url(route('logout')),
            ]);
        });

        // Missing in FilamentCompaniesServiceProvider.php
        RedirectResponse::macro('banner', fn($message) => $this->with('flash', [
            'bannerStyle' => 'success',
            'banner' => $message,
        ]));

        RedirectResponse::macro('dangerBanner', fn($message) => $this->with('flash', [
            'bannerStyle' => 'danger',
            'banner' => $message,
        ]));

        Filament::registerRenderHook(
            'content.start',
            fn(): string => Blade::render('<x-filament-companies::banner />'),
        );

        $this->configurePermissions();

        FilamentCompanies::createCompaniesUsing(CreateCompany::class);
        FilamentCompanies::updateCompanyNamesUsing(UpdateCompanyName::class);
        FilamentCompanies::addCompanyEmployeesUsing(AddCompanyEmployee::class);
        FilamentCompanies::inviteCompanyEmployeesUsing(InviteCompanyEmployee::class);
        FilamentCompanies::removeCompanyEmployeesUsing(RemoveCompanyEmployee::class);
        FilamentCompanies::deleteCompaniesUsing(DeleteCompany::class);
        FilamentCompanies::deleteUsersUsing(DeleteUser::class);

        Socialite::resolvesSocialiteUsersUsing(ResolveSocialiteUser::class);
        Socialite::createUsersFromProviderUsing(CreateUserFromProvider::class);
        Socialite::createConnectedAccountsUsing(CreateConnectedAccount::class);
        Socialite::updateConnectedAccountsUsing(UpdateConnectedAccount::class);
        Socialite::setUserPasswordsUsing(SetUserPassword::class);
        Socialite::handlesInvalidStateUsing(HandleInvalidState::class);
        Socialite::generatesProvidersRedirectsUsing(GenerateRedirectForProvider::class);
    }

    /**
     * Configure the roles and permissions that are available within the application.
     *
     */
    protected function configurePermissions(): void
    {
        FilamentCompanies::defaultApiTokenPermissions(['read']);

        foreach (Role::all() as $role) {
            FilamentCompanies::role($role->key, $role->name, $role->permissions)
                ->description($role->description ?? '');
        }
    }
}
