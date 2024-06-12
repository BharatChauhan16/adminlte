<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use App\AddUser;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected function guard()
    {
        return Auth::guard('web');
    }

    protected function credentials(Request $request)
    {
        // Check if the user exists in the 'users' table
        $defaultCredentials = $request->only('email', 'password');
        if (Auth::attempt($defaultCredentials)) {
            return $defaultCredentials;
        }

        // Check if the user exists in the 'addusers' table
        $addUser = AddUser::where('email', $request->email)->first();
        if ($addUser && Hash::check($request->password, $addUser->password)) {
            return ['email' => $request->email, 'password' => $request->password];
        }

        // Neither found, return empty array
        return [];
        // return $request->only('email', 'password');
    }
}
