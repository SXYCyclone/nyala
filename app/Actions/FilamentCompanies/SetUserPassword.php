<?php

namespace App\Actions\FilamentCompanies;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Wallo\FilamentCompanies\Contracts\SetsUserPasswords;
use Laravel\Fortify\Rules\Password;

class SetUserPassword implements SetsUserPasswords
{
    /**
     * Validate and update the user's password.
     *
     * @return void
     */
    public function set(mixed $user, array $input)
    {
        Validator::make($input, [
            'password' => ['required', 'string', new Password, 'confirmed'],
        ])->validateWithBag('setPassword');

        $user->forceFill([
            'password' => Hash::make($input['password']),
        ])->save();
    }
}
