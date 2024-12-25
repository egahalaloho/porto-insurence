<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function showLoginForm(){
        return "Hello This is Login Form";
    }

    public function validateUserName(Request $request) {
        dd($request->all());
    }

    public function validatePassword(Request $request){
        dd($request->all());
    }
}
