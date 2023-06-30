<?php
/**
 * @author: RonTea
 * Website: https://live-rontea.pantheonsite.io/
 * Version: 0
 * Date: June, 30, 2023
 * File: app\Http\Controllers\AuthLoginController.php
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Class AuthLoginController
 * implies that the controller handles authentication-related
 * actions, including login and logout. Class extends Controller
 *
 * @author RonTea
 * @version 0
 */

class AuthLoginController extends Controller
{
    /**
     * Login the user by authenticating and creating session
     * @param Request Object that encapsulates incoming HTTP request
     * @return redirect Object the perform redirects
     */

    public function login(Request $request){

        // check validation parameters should be required
        $incomingFields = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);
        // use auth method to authenticate
        if (auth()->attempt([
            'username' => $incomingFields['username'],
            'password' => $incomingFields['password']
        ])){

            $request->session()->regenerate();
            // Perform a link route redirect
            return redirect('/loginhome');
        }else {
            // Perform redirect with flash data of error
            return redirect()->back()->with('error', 'Login failed. Please check your credentials.');
        }

    }

    /**
     *Logout the client which will destroy the session
     * @return redirect Object the perform redirect
     */

    public function logout(){
        // logout
        auth()->logout();
        // return to home
        return redirect('/');
    }
}
