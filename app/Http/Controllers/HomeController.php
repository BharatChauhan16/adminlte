<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Permission;
use App\Models\Attendance;
use App\Models\Breaks;
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
    $user = auth()->user();
    $attendance = Attendance::where('user_id', $user->id)->latest()->first();

    $clockInTime = null;
    $clockOutTime = null;
    $productiveHours = '00:00:00'; // Default value

    $breaks = Breaks::where('attendance_id', $attendance ? $attendance->id : null)->get();
    $attendanceId = $attendance ? $attendance->id : null;

    if ($attendance) {
        $clockInTime = $attendance->clockin_time ? Carbon::parse($attendance->clockin_time) : null;
        $clockOutTime = $attendance->clockout_time ? Carbon::parse($attendance->clockout_time) : null;

        // Calculate productive hours if both clock in and clock out times are set
        if ($clockInTime && $clockOutTime) {
            $productiveHours = $clockOutTime->diff($clockInTime)->format('%H:%I:%S');
        }
    }

    return view('home', compact('clockInTime', 'clockOutTime', 'productiveHours', 'breaks', 'attendanceId', 'attendance'));
}
public function clockIn(Request $request)
{
    $attendance = Attendance::create([
        'user_id' => Auth::id(),
        'clockin_time' => now(),
    ]);

    return response()->json(['message' => 'Clock in successful']);
}

public function clockOut(Request $request)
{
    $attendance = Attendance::where('user_id', Auth::id())
        ->whereNull('clockout_time')
        ->latest()
        ->first();

    if ($attendance) {
        $attendance->update([
            'clockout_time' => now(),
        ]);
    }

    // Calculate productive hours
    $productiveHours = null;
    if ($attendance->clockin_time && $attendance->clockout_time) {
        $clockIn = Carbon::parse($attendance->clockin_time);
        $clockOut = Carbon::parse($attendance->clockout_time);
        $productiveHours = $clockOut->diffInHours($clockIn);
    }

    $attendance->update([
        'productive_hours' => $productiveHours,
    ]);

    return response()->json(['message' => 'Clock out successful']);
}
public function saveProductiveHours(Request $request)
{
    $attendance = Attendance::where('user_id', Auth::id())
        ->whereNotNull('clockin_time')
        ->whereNotNull('clockout_time')
        ->latest()
        ->first();

    if ($attendance) {
        // Update productive hours
        $productiveHours = $request->input('productiveHours');
        $attendance->update([
            'productive_hours' => $productiveHours,
        ]);

        return response()->json(['message' => 'Productive hours saved successfully']);
    }

    return response()->json(['error' => 'No valid attendance found'], 404);
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
