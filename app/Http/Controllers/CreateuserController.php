<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Adduser;
use Illuminate\Support\Facades\Hash;



class CreateuserController extends Controller
{
    public function create()
    {
        return view('users.create_users');
        

    }

    public function addUsers(Request $request)
   {
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:addusers',
        'password' => 'required|string|min:8',
        'role' => 'required|string',
    ]);

    Adduser::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => $request->role,
    ]);
    // $request->validate([
    //     'name' => 'required|string|max:255',
    //     'email' => 'required|email|unique:addusers',
    //     'password' => 'required|string|min:15',
    //     'role' => 'required|in:admin,editor,viewer',
    // ]);

    // Adduser::create($request->all());


    // dd($request->all());

    return redirect('/home');
   }
 }


