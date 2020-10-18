<?php

namespace App\Actions\Fortify;

use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Create a newly registered user.
     *
     * @param array $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'inn' => ['required', 'string', 'max:255', 'unique:users'],
            'f_name' => ['required', 'string', 'max:255',],
            'l_name' => ['required', 'string', 'max:255',],
            'm_name' => ['required', 'string', 'max:255',],
            'phone' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
        ])->validate();
        $user = User::create([
            'inn' => $input['inn'],
            'f_name' => $input['f_name'],
            'l_name' => $input['l_name'],
            'm_name' => $input['m_name'],
            'phone' => $input['phone'],
            'employ_date' => $input['employ_date'],
            'employ_document_date' => $input['employ_document_date'],
            'employ_document_number' => $input['employ_document_number'],
            'department_id' => $input['department_id'],
            'salary' => $input['salary'],
            'adress' => $input['adress'],
            'password' => Hash::make($input['password']),
        ]);
        $this->createTeam($user);
        $user->syncRoles($input['roles']);
        $user->workDays()->create();
        return $user;
    }

    /**
     * Create a personal team for the user.
     *
     * @param \App\Models\User $user
     * @return void
     */
    protected function createTeam(User $user)
    {
        $user->ownedTeams()->save(Team::forceCreate([
            'user_id' => $user->id,
            'name' => explode(' ', $user->name, 2)[0] . "'s Team",
            'personal_team' => true,
        ]));
    }
}
