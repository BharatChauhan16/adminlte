<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Adduser;


class ShowuserController extends Controller
{
    public function index()
    {
        $users = Adduser::all();
        return view('users.show_users', [
            'users' => $users
        ]);
        // return view('home');
    }
}
