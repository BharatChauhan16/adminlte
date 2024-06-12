<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Adduser;
use App\Models\UserProfile;
use App\Models\Permission;
use Illuminate\Support\Facades\Hash;



class CreateuserController extends Controller
{
    public function create()
    {
        $users = Adduser::all();
        // $users = Adduser::paginate(4);
        return view('users.create_users', [
            'users' => $users
        ]);    
    }

    public function addUsers(Request $request)
   {

    // Adduser::create($request->all());
    // return redirect('/admin/users');
    // $request->validate([
    //     'name' => 'required|string|max:255',
    //     'email' => 'required|string|email|max:255|unique:addusers',
    //     'password' => 'required|string|min:8',
    //     'role' => 'required|string',
    // ]);

    Adduser::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'role' => $request->role,
    ]);
    return redirect('/admin/users')->with('adduser', 'User added successfully.');
    // Adduser::create($request->all());
    // dd($request->all());    
   }
 }


