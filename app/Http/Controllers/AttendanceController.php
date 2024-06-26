<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Breaks;
use App\Models\User;
use Carbon\Carbon;
use Auth;

class AttendanceController extends Controller
{
    public function clockIn(Request $request)
    {
        $attendance = Attendance::where('user_id', auth()->id())->firstOrCreate([
            'user_id' => auth()->id()
        ]);

        $attendance->clockin_time = now();
        $attendance->save();

        return redirect()->back();
    }

    public function clockOut(Request $request)
    {
        $attendance = Attendance::where('user_id', auth()->id())->first();
        
        if ($attendance) {
            $attendance->clockout_time = now();
            $attendance->save();
        }

        return redirect()->back();
    }

    public function saveProductiveHours(Request $request)
    {
        $attendance = Attendance::where('user_id', auth()->id())->first();

        if ($attendance && $request->has('productive_hours')) {
            $attendance->productive_hours = $request->productive_hours;
            $attendance->save();
        }

        return redirect()->back();
    }
}
