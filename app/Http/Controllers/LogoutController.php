<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;

class LogoutController extends Controller
{
    public function logout()
    {
        Auth::logout();
        return redirect('login');
    }
}