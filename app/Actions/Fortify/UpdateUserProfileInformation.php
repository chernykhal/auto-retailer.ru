<?php

namespace App\Actions\Fortify;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param mixed $user
     * @param array $input
     * @return void
     */
    public function update($user, array $input)
    {

        Validator::make($input, [
            'inn' => ['required', 'digits_between:1,255', Rule::unique('users')->ignore($user)],
            'f_name' => ['required', 'string', 'max:255',],
            'l_name' => ['required', 'string', 'max:255',],
            'm_name' => ['required', 'string', 'max:255',],
            'adress' => ['required', 'string', 'max:255',],
            'phone' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($user)],
            'photo' => ['nullable', 'image', 'max:1024'],
        ])->validateWithBag('updateProfileInformation');

        if (isset($input['photo'])) {
            $user->updateProfilePhoto($input['photo']);
        }
        $user->update([
            'inn' => $input['inn'],
            'f_name' => $input['f_name'],
            'l_name' => $input['l_name'],
            'm_name' => $input['m_name'],
            'phone' => $input['phone'],
            'adress' => $input['adress'],
        ]);
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param mixed $user
     * @param array $input
     * @return void
     */
    protected function updateVerifiedUser($user, array $input)
    {
        $user->forceFill([
            'name' => $input['name'],
            'email' => $input['email'],
            'email_verified_at' => null,
        ])->save();

        $user->sendEmailVerificationNotification();
    }
}
