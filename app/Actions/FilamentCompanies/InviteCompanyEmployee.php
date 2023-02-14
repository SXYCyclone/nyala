<?php

namespace App\Actions\FilamentCompanies;

use App\Helpers\RoleHelper;
use App\Models\Company;
use App\Models\User;
use Closure;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Wallo\FilamentCompanies\Contracts\InvitesCompanyEmployees;
use Wallo\FilamentCompanies\Events\InvitingCompanyEmployee;
use Wallo\FilamentCompanies\FilamentCompanies;
use Wallo\FilamentCompanies\Mail\CompanyInvitation;
use Wallo\FilamentCompanies\OwnerRole;
use Wallo\FilamentCompanies\Rules\Role;

class InviteCompanyEmployee implements InvitesCompanyEmployees
{
    /**
     * Invite a new company employee to the given company.
     */
    public function invite(User $user, Company $company, string $email, string $role = null): void
    {
        Gate::forUser($user)->authorize('addCompanyEmployee', $company);

        $this->validate($company, $email, $role);

        InvitingCompanyEmployee::dispatch($company, $email, $role);

        $invitation = $company->companyInvitations()->create([
            'email' => $email,
            'role' => $role,
        ]);

        Mail::to($email)->send(new CompanyInvitation($invitation));
    }

    /**
     * Validate the invite employee operation.
     */
    protected function validate(Company $company, string $email, ?string $role): void
    {
        Validator::make([
            'email' => $email,
            'role' => $role,
        ], $this->rules($company), [
            'email.unique' => __('This employee has already been invited to the company.'),
        ])
            ->after($this->ensurePersonalCompanyInvitesIsEnabled($company))
            ->after($this->ensureUserIsNotAlreadyOnCompany($company, $email))
            ->after($this->ensureUserCanInviteRole($company, $role))
            ->validateWithBag('addCompanyEmployee');
    }

    /**
     * Get the validation rules for inviting a company employee.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    protected function rules(Company $company): array
    {
        return array_filter([
            'email' => [
                'required', 'email',
                Rule::unique('company_invitations')->where(function (Builder $query) use ($company) {
                    $query->where('company_id', $company->id);
                }),
            ],
            'role' => FilamentCompanies::hasRoles()
                ? ['required', 'string', new Role]
                : null,
        ]);
    }

    /**
     * Ensure that the employee is not already on the company.
     */
    protected function ensureUserIsNotAlreadyOnCompany(Company $company, string $email): Closure
    {
        return function ($validator) use ($company, $email) {
            $validator->errors()->addIf(
                $company->hasUserWithEmail($email),
                'email',
                __('This employee already belongs to the team.')
            );
        };
    }

    /**
     * Ensure that personal company invites are enabled.
     */
    protected function ensurePersonalCompanyInvitesIsEnabled(Company $company): Closure
    {
        return function ($validator) use ($company) {
            $validator->errors()->addIf(
                $company->personal_company && !config('nyala.company.allow_personal_company_invites'),
                'email',
                __('Personal companies is not allowed to invite employees. Please create a new company.')
            );
        };
    }

    protected function ensureUserCanInviteRole(Company $company, string $role): Closure
    {
        return function ($validator) use ($company, $role) {
            if (auth()->user()->current_company_role instanceof OwnerRole) {
                return;
            }
            $validator->errors()->addIf(
                RoleHelper::compareRoleLevel($role, auth()->user()->current_company_role) < 0,
                'email',
                __('You are only allowed to invite employees with a lower role than your current role.')
            );
        };
    }
}
