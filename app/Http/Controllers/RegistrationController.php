<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests;

class RegistrationController extends Controller
{
    public function register(){
        return view('auth.register');
    }


    public function postRegister(Request $request){

        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);

        $user = User::create($request->all());

        flash('You have successfully added a event coordinator.');

        return redirect()->back();
    }
}
