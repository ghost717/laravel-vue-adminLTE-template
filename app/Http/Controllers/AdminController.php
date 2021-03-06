<?php

namespace App\Http\Controllers;

use Auth;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (Auth::check()) {
            return view('admin');
        }
        return redirect('/');
    }
}
