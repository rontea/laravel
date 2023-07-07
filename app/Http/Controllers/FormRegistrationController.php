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
use App\Actions\Fortify\CreateNewUser;


/**
 *Class FormRegistrationController
 * implies that the controller handles the registration process
 * extends Controller
 * @author RonTea
 * @version 0
 */

class FormRegistrationController extends Controller
{

    public function getListName(){
        // use the model methods in getting the user
        $user = User::where('email', 'ronryanteano@gmail.com')->first();
        return view('pages.index', compact('user'));
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
        return view('pages.liveusernamechecking');
    }
}
