<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'first_name' => ['required','max:255'],
            'last_name' => ['required', 'max:255'],
            'username' => [
                'required',
                'regex:/\S+/',
                'min:5',
                'max:60',
                Rule::unique(User::class)
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
            'password_confirmation' => ['required'],
        ] , [
            'first_name.required' => 'First Name is required',
            'last_name.required' => 'Last Name is required',
            'username.min' => 'Username should be at least 5 characters long',
            'username.regex' => 'Username should not have whitespace',
            'password.regex' => 'Password
                                must contain at least one uppercase letter, one special
                                character, one lowercase letter, one number and no whitespace.',
        ])->validate();

        if(!isset($input['middle_name'])) {
            $input['middle_name'] = Null;
        }

        return User::create([
            'first_name' => $input['first_name'],
            'middle_name' => $input['middle_name'],
            'last_name' => $input['last_name'],
            'username' => $input['username'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
