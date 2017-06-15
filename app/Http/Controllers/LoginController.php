<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }
    
    public function login(Request $request)
    {
        // authenticate the user
        
        if (Auth::attempt(['email' => $request->email, 'password' =>  $request->password]))
        {
            if(Auth::user()->customer_id == 0)
            {
                return redirect('/deal');
            }
            else
            {
                return redirect('/shop');
            }
        }
        else
        {
             return view('login', ['error' => 'Invalid Credentials. Please try again.']);
        }
    }
}