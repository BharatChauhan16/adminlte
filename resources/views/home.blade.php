@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-4 col-xs-6">
            <!-- Clock In -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3 id="clockInTime">{{ $clockInTime ? $clockInTime->format('h:i A') : 'Not Clocked In' }}</h3>
                </div>
                <div class="icon">
                    <i class="fas fa-sign-in-alt"></i>
                </div>
                <form action="{{ route('clockin') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success">Clock In</button>
                </form>
            </div>
        </div>
        <div class="col-lg-4 col-xs-6">
            <!-- Clock Out -->
            <div class="small-box bg-red">
                <div class="inner">
                    <h3 id="clockOutTime">{{ $clockOutTime ? $clockOutTime->format('h:i A') : 'Not Clocked Out' }}</h3>
                </div>
                <div class="icon">
                    <i class="fas fa-sign-out-alt"></i>
                </div>
                <form action="{{ route('clockout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger">Clock Out</button>
                </form>
            </div>
        </div>
        <div class="col-lg-4 col-xs-6">
            <!-- Productive Hours -->
            <div class="small-box bg-blue">
                <div class="inner">
                    <h3 id="productiveHours">{{ $productiveHours }}</h3>
                    <p>Productive Hours</p>
                </div>
                <div class="icon">
                    <i class="fas fa-hourglass-half"></i>
                </div>
            </div>
        </div>
    </div>

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#breakModal" style="margin-top: 10px;">
        <i class="fas fa-plus-circle mr-2"></i> Add Break
    </button>

    <!-- Break Listing -->
    <div class="table-responsive" style="margin-top: 20px;">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Start Time</th>
                    <th>Break Reason</th>
                    <th>Break Time</th>
                    <th>End Break</th>
                </tr>
            </thead>
            <tbody>
                @foreach($breaks as $break)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($break->start_time)->format('h:i A') }}</td>
                        <td>{{ $break->reason }}</td>
                        <td>
                            <span class="break-timer" data-start-time="{{ \Carbon\Carbon::parse($break->start_time)->toIso8601String() }}">
                                @if($break->end_time)
                                    {{ \Carbon\Carbon::parse($break->start_time)->diff(\Carbon\Carbon::parse($break->end_time))->format('%H:%I:%S') }}
                                @else
                                    00:00:00
                                @endif
                            </span>
                        </td>
                        <td>
                            @if(!$break->end_time)
                                <form action="{{ route('breaks.end', $break->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">End Break</button>
                                </form>
                            @else
                                {{ \Carbon\Carbon::parse($break->end_time)->format('h:i A') }}
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @include('modals.add_break_modal')
@stop

@section('css')
    {{-- Add your custom stylesheets here --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script>
        console.log("Hi, I'm using the Laravel-AdminLTE package!");

        // Timer logic
        let clockInTime = "{{ $clockInTime ? $clockInTime->toIso8601String() : null }}";
        let clockOutTime = "{{ $clockOutTime ? $clockOutTime->toIso8601String() : null }}";
        let productiveHoursElement = document.getElementById('productiveHours');

        if (clockInTime && !clockOutTime) {
            setInterval(() => {
                let now = new Date();
                let clockIn = new Date(clockInTime);
                let diff = new Date(now - clockIn);
                let hours = diff.getUTCHours().toString().padStart(2, '0');
                let minutes = diff.getUTCMinutes().toString().padStart(2, '0');
                let seconds = diff.getUTCSeconds().toString().padStart(2, '0');
                productiveHoursElement.innerHTML = `${hours}:${minutes}:${seconds}`;
            }, 1000);
        }

        // Break timers
        const breakTimers = document.querySelectorAll('.break-timer');

        breakTimers.forEach(timer => {
            const startTime = timer.dataset.startTime;

            if (startTime) {
                setInterval(() => {
                    let now = new Date();
                    let start = new Date(startTime);
                    let diff = new Date(now - start);
                    let hours = diff.getUTCHours().toString().padStart(2, '0');
                    let minutes = diff.getUTCMinutes().toString().padStart(2, '0');
                    let seconds = diff.getUTCSeconds().toString().padStart(2, '0');
                    timer.innerHTML = `${hours}:${minutes}:${seconds}`;
                }, 1000);
            }
        });
    </script>
@stop
