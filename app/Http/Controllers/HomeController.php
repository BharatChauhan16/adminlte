<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserProfile;
use App\Models\Permission;
use App\Models\Attendance;
use App\Models\Break;
use Carbon\Carbon;
use Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $userId = auth()->user()->id;
        $attendance = Attendance::where('user_id', $userId)->latest()->first();
        $clockInTime = $attendance && $attendance->clockin_time ? new Carbon($attendance->clockin_time) : null;
        $clockOutTime = $attendance && $attendance->clockout_time ? new Carbon($attendance->clockout_time) : null;
        $productiveHours = $attendance ? $attendance->productive_hours : '00:00:00';
        
        // Fetch breaks associated with the current attendance
        $breaks = $attendance ? $attendance->breaks : collect();

        return view('home', compact('clockInTime', 'clockOutTime', 'productiveHours', 'breaks'));
    }

    public function showUser()
    {
        $users = User::all();
        $permissions = Permission::all();
        return view('users.show_users', [
            'users' => $users,
            'permissions' => $permissions,
        ]);
    }
}

