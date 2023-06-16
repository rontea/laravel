<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class FormRegistrationController extends Controller
{
    public function showForm(){
        return view('registration');
    }
    public function register(Request $request){

        // validate inputs
        $registrationFields = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'username' => ['required','regex:/\S+/','min:5'],
            'email' => ['required', 'email'],
            'password' => [
                'required',
                'min:8',
                'regex:/[!@#$%^&*()_+\-=[\]{};\'\\:"|,.<>\/?]/',
                'regex:/\S+/',
                'regex:/[A-Z]/',
                'regex:/[a-z]/',
                'regex:/[0-9]/',
                'max:200',

            ],
            'confirmPassword' => ['required', 'same:password'],
        ], [
            'confirmPassword.confirmed' => 'Confirm Password and Password do not Match',
        ]);

        // check for unique duplicates user and email


        // use bcrypt
        $registrationFields['password'] = bcrypt($registrationFields['password']);
        unset($registrationFields['confirmPassword']);

        // write to database
        try {
            $user = User::create($registrationFields);
            $user->save();
        }catch (QueryException $e){
            $e->getMessage();
        }
       return "Hello from controller";

    }
}
