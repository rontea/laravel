<?php

/**
 * @author: RonTea
 * Website: https://live-rontea.pantheonsite.io/
 * Version: 0
 * Date: June, 30, 2023
 * File: app\Http\Controllers\FormRegistrationController.php
 */

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

/**
 *Class FormRegistrationController
 * implies that the controller handles the registration process
 * extends Controller
 * @author RonTea
 * @version 0
 */

class FormRegistrationController extends Controller
{
    /**
    * @var object The name of the database for class use
    */

    private $data;

    /**
    * @var string The link of the user profile or dashboard
    */

    private $loginHomeLink = "/loginhome";

    /**
    * @var string The home link
    */
    private $homeLink = "/";

    /**
    * @var string The name of the registration page
    */

    private $registrationPage = "/registration";

    /**
     * Route page registration
     * @return view return the view page registration
     */

    public function showForm(){
        // return view but use name of route not link
        return view('registration');
    }

    /**
     * Registration process of a new account
     * @param Request Object that encapsulates incoming HTTP request
     * @return redirect redirect to page if successful or return error
     */

    public function register(Request $request){

        /**
         *  Make sure that you use the exact name of
         *  the database variable on your array
         */

        // validate inputs
        $registrationFields = $request->validate([
            'first_name' => ['required','max:255'],
            'last_name' => ['required', 'max:255'],
            // check for unique duplicates user and email
            'username' => ['required','regex:/\S+/','min:5', 'max:60', Rule::unique('users', 'username')],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
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
            'first_name.required' => 'First Name is required',
            'last_name.required' => 'Last Name is required',
            'username' => 'Username should be at least 5 characters long and should not have whitespace',
            'password' => 'Password should be at least 8 characters, must contain at least one uppercase letter, one special character, one lowercase letter, one number and no whitespace.'
        ]);

        // check if parameters are correct if not return message error
        if(!$registrationFields){
            // withInput() make sure that the input data previously entered are available
            return redirect()->back()->withErrors($registrationFields)->withInput();
        }else {
            // use bcrypt for the password encryption
            $registrationFields['password'] = bcrypt($registrationFields['password']);
            // remove confirm password on array
            unset($registrationFields['confirmPassword']);

            // add the new account to database
            $this->setUsers($registrationFields);

            // create the session login
            auth()->login($this->data);

            // go to the dashboard
            return redirect()->route('loginhome');
        }

    }

    /**
     * Safely write the needed attributes to the database
     *
     * @param Object The Request data
     *
     */


    protected function setUsers($newUser){

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
            $this->data = User::create($user);
            $this->data->save();

        }catch (Exception $e){

            echo $e->getMessage();;
        }

    }

    /**
     * Test reading database
     */

    public function getListName(){
        // use the model methods in getting the user
        $user = User::where('email', 'ronryanteano@gmail.com')->first();
        return view('home', compact('user'));
    }

    /**
     * Test live view JSON
     */

    public function checkUsernameAvailability(Request $request){

        $username = $request->input('username');

        // query username
        $user = User::where('username', $username)->first();

        // Prepare the response data set value if null false and if not true
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
