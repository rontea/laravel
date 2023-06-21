<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class FormRegistrationController extends Controller
{
    public function showForm(){
        return view('registration');
    }
    public function register(Request $request){

        /**
         *  Make sure that you use the exact name of the database variable on your array
         */

        // validate inputs
        $registrationFields = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            // check for unique duplicates user and email
            'username' => ['required','regex:/\S+/','min:5', Rule::unique('users')],
            'email' => ['required', 'email', Rule::unique('users')],
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


        // use bcrypt on form data
        $registrationFields['password'] = bcrypt($registrationFields['password']);
        // remove confirm password on array
        unset($registrationFields['confirmPassword']);

        //dd($registrationFields);
        $this->setUsers($registrationFields);

        return 'hello';

    }

    protected function setUsers($newUser){

        /**
         * Safely write the needed attributes to the database
         */

        // check if middle name is available because it is null
        if (!isset($newUser['middle_name'])){
            $newUser['middle_name']  = Null;
        }

        $user = [];

        $user['first_name'] = $newUser['first_name'];
        $user['middle_name'] = $newUser['middle_name'];
        $user['last_name'] = $newUser['last_name'];
        $user['username'] = $newUser['username'];
        $user['email'] = $newUser['email'];
        $user['password'] = $newUser['password'];

        // write to database
        try {
            // write and save to database
            $data = User::create($user);
            $data->save();
        }catch (Exception $e){

            echo $e->getMessage();;
        }

    }

    public function getListName(){

        $user = User::where('email', 'ronryanteano@gmail.com')->first();
        return view('home', compact('user'));
    }

    // testing information
    public function checkUsernameAvailability(Request $request){

        $username = $request->input('username');

        // query username
        $user = User::where('username', $username)->first();

        // Prepare the response data
        $response = [
            'available' => $user ? false : true
        ];

        // Return the response as JSON
        return response()->json($response);
    }

    public function showFormUser(){
        return view('liveusernamechecking');
    }
}
