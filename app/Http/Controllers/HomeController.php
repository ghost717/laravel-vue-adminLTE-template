<?php

namespace App\Http\Controllers;

use Auth;

use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if (Auth::check()) {
            return redirect('/admin/dashboard');
        }
        return redirect('/');
    }
}
