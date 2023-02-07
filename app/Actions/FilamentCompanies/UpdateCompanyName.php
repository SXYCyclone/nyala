<?php

namespace App\Actions\FilamentCompanies;

use App\Models\Company;
use App\Models\User;
use Closure;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Wallo\FilamentCompanies\Contracts\UpdatesCompanyNames;

class UpdateCompanyName implements UpdatesCompanyNames
{
    /**
     * Validate and update the given company's name.
     *
     * @param array<string, string> $input
     */
    public function update(User $user, Company $company, array $input): void
    {
        Gate::forUser($user)->authorize('update', $company);

        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
        ])
            ->after($this->ensurePersonalCompanyRenameIsEnabled($company))
            ->validateWithBag('updateCompanyName');

        $company->forceFill([
            'name' => $input['name'],
        ])->save();
    }

    public function ensurePersonalCompanyRenameIsEnabled(Company $company): Closure
    {
        return function ($validator) use ($company) {
            $validator->errors()->addIf(
                $company->personal_company && !config('nyala.company.allow_personal_company_rename'),
                'name',
                __('Personal company names cannot be changed.')
            );
        };
    }
}
