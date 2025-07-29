<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param array<string, string> $input
     */
    public function update(User $user, array $input): void
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:255'],
            'state' => ['nullable', 'string', 'max:255'],
            'postal_code' => ['nullable', 'string', 'max:255'],
        ])->validateWithBag('updateProfileInformation');

        $user->forceFill([
            'name' => $input['name'],
            'email' => $user->email ?? null,
            'phone_number' => $input['phone_number'],
            'address' => $input['address'] ?? null,
            'city' => $input['city'] ?? null,
            'state' => $input['state'] ?? null,
            'postal_code' => $input['postal_code'] ?? null,
        ])->save();
    }

    // /**
    //  * Update the given verified user's profile information.
    //  *
    //  * @param array<string, string> $input
    //  */
    // protected function updateVerifiedUser(User $user, array $input): void
    // {
    //     $user->forceFill([
    //         'name'              => $input['name'],
    //         'email'             => $input['email'],
    //         'email_verified_at' => null,
    //     ])->save();

    //     $user->sendEmailVerificationNotification();
    // }
}
