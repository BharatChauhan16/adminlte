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
    return view('home');
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
public function saveBreak(Request $request)
{
    $break = new Breaks();
    $break->attendance_id = 1; // Replace with actual attendance ID
    $break->reason = $request->reason;
    $break->start_time = now(); // Current time
    $break->save();

    return response()->json($break);
}

public function endBreak($id)
{
    $break = Breaks::findOrFail($id);
    $break->end_time = now(); // Current time
    $break->save();

    return response()->json($break);
}
public function calculateProductiveHours(Request $request)
{
    $attendance = Attendance::where('user_id', Auth::id())
        ->whereNotNull('clockin_time')
        ->whereNotNull('clockout_time')
        ->latest()
        ->first();

    if ($attendance) {
        // Get total break time
        $breaks = Breaks::where('attendance_id', $attendance->id)->get();
        $totalBreakTime = 0;

        foreach ($breaks as $break) {
            if ($break->end_time) {
                $start = Carbon::parse($break->start_time);
                $end = Carbon::parse($break->end_time);
                $totalBreakTime += $end->diffInSeconds($start);
            }
        }

        // Calculate productive hours
        $clockIn = Carbon::parse($attendance->clockin_time);
        $clockOut = Carbon::parse($attendance->clockout_time);
        $totalWorkTime = $clockOut->diffInSeconds($clockIn);
        $productiveTime = $totalWorkTime - $totalBreakTime;

        $hours = floor($productiveTime / 3600);
        $minutes = floor(($productiveTime % 3600) / 60);
        $seconds = $productiveTime % 60;
        $formattedProductiveHours = sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);

        return response()->json(['success' => true, 'productiveHours' => $formattedProductiveHours]);
    }

    return response()->json(['success' => false, 'error' => 'No valid attendance found'], 404);
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