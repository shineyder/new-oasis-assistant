<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function handleLogin()
    {
        if (Auth::check()) :
            return redirect(Route('profile'));
        else :
            return view('auth.login');
        endif;
    }
}
