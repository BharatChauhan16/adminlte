<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Breaks;
use App\Models\Attendance;
use Carbon\Carbon;
use Auth;

class BreakController extends Controller
{
    public function startBreak(Request $request)
    {
        $attendance = Attendance::where('user_id', Auth::id())->whereNull('clockout_time')->first();

        if ($attendance) {
            $break = Breaks::create([
                'attendance_id' => $attendance->id,
                'start_time' => Carbon::now(),
                'reason' => $request->reason,
            ]);

            return redirect()->back()->with('success', 'Break started successfully');
        }

        return redirect()->back()->with('error', 'Unable to start break');
    }

    public function endBreak($id)
    {
        $break = Breaks::findOrFail($id);
        $break->update([
            'end_time' => Carbon::now(),
        ]);

        return redirect()->back()->with('success', 'Break ended successfully');
    }
}
