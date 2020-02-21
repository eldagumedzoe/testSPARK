<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator,Redirect,Response;
use Illuminate\Support\Facades\Hash;
use Session;
use App\Http\Controllers\Controller;
use App\User;


class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('auth.login');
    }

    /**
     * Login.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
       $request->validate([

            'email'       => 'required|string',
            'password'    => 'required|string',
        ]);
        //$credentials = $request->only('email', 'password');
        $user = array('email'  => $request->email,'password' => $request->password);

        if (Auth::attempt($user)) {

            return redirect()->route('dashboard.index');
        }else{

           return redirect()->route('login.index')->with('message', "Incorrect email and password");
        }
    }

    /**
     * logout.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request  $request) 
    {

        Session::flush();
        Auth::logout();
        return redirect()->route('login.index')->with('message', "Déconnexion");
    }
}
