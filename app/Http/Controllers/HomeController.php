<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Adduser;
use App\Models\UserProfile;
use App\Models\Permission;
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
        return view('home');
    }
    public function showUser()
    {
        $addusers = Adduser::all();
        // $users = Adduser::paginate(4);
        return view('users.show_users', [
            'addusers' => $addusers
        ]);
    }
}
