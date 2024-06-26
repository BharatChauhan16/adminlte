<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Breaks;
use App\Models\Attendance;
use Carbon\Carbon;

class BreaksController extends Controller
{
    public function addBreak(Request $request)
    {
        $attendance = Attendance::where('user_id', auth()->id())->latest()->first();

        $break = new Breaks();
        $break->attendance_id = $attendance->id;
        $break->start_time = now();
        $break->reason = $request->input('reason');
        $break->save();

        return redirect()->route('home')->with('success', 'Break started successfully.');
    }
}