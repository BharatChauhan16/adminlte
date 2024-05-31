<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Adduser;


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
        $users = Adduser::all();
        return view('home', [
            'users' => $users
        ]);
        // return view('home');
    }
}
