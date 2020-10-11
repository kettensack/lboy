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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $user = Auth::user();
        // $user->authorizeRoles(['admin']);
        // if (\Gate::allows('isAdmin')) {
        //     return view('welcome');
        // } else {
        //     return view('home');
        // }
        // allows
    if (\Gate::allows('isAdmin')) {
        return view('index');
    } else {
        return view('index');
    }

	  // denies
    if (\Gate::denies('isAdmin')) {
        return view('index');
    } else {
        return view('index');
    }

    }
}
