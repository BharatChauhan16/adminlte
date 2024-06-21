<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserProfile;
use App\Models\Permission;
use App\Models\Attendance;
use App\Models\Breaks;
use Carbon\Carbon;
use Auth;



class AttendanceController extends Controller
{
    public function clockIn(Request $request)
    {
        $attendance = new Attendance();
        $attendance->user_id = auth()->user()->id;
        $attendance->clockin_time = now();
        $attendance->save();

        return redirect()->route('home');
    }

    public function clockOut(Request $request)
    {
        $attendance = Attendance::where('user_id', auth()->user()->id)
                                ->whereNull('clockout_time')
                                ->latest()
                                ->first();

        if ($attendance) {
            $attendance->clockout_time = now();
            $attendance->save();
        }

        return redirect()->route('home');
    }
}
