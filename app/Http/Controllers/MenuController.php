<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;

class MenuController extends Controller
{
    public function index()
    {
        return view('menu');
    }
}