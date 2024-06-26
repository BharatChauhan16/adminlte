@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
<style>
    /* YOUR CSS CODE */
</style> 
    <div class="row">
        <div class="col-lg-4 col-xs-6">
            <!-- Clock In -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3 class="box-title">Clock In</h3>
                    <p id="clockInTime">00:00:00</p>
                </div>
                <div class="icon">
                    <i class="fas fa-sign-in-alt"></i>
                </div>
                
                <button id="clockInBtn" class="btn btn-success">Clock In</button>
            </div>
        </div>

        <div class="col-lg-4 col-xs-6">
            <!-- Clock Out -->
            <div class="small-box bg-red">
                <div class="inner">
                    <h3 class="box-title">Clock Out</h3>
                    <p id="clockOutTime">00:00:00</p>
                </div>
                <div class="icon">
                    <i class="fas fa-sign-out-alt"></i>
                </div>
                <button id="clockOutBtn" class="btn btn-danger">Clock Out</button>
            </div>
        </div>

        <div class="col-lg-4 col-xs-6">
            <!-- Productive Hours -->
            <div class="small-box bg-blue">
                <div class="inner">
                    <h3 class="box-title">Productive Hours</h3>
                    <p id="productiveHoursTimer">00:00:00</p>
                </div>
                <div class="icon">
                    <i class="fas fa-hourglass-half"></i>
                </div>
                <button id="productiveHoursBtn" class="btn btn-primary">Save Productive Hours</button>
            </div>
        </div>







    </div>

@stop

@section('js')
    <script>
        // Stopwatch timer logic
        let timerInterval;
        let productiveHours = 0;

        function startTimer() {
            let startTime = new Date().getTime();
            timerInterval = setInterval(function() {
                let currentTime = new Date().getTime();
                let elapsedTime = currentTime - startTime;
                let hours = Math.floor(elapsedTime / (1000 * 60 * 60));
                let minutes = Math.floor((elapsedTime % (1000 * 60 * 60)) / (1000 * 60));
                let seconds = Math.floor((elapsedTime % (1000 * 60)) / 1000);
                document.getElementById("productiveHoursTimer").innerText = `${hours}:${minutes}:${seconds}`;
            }, 1000);
        }

        function stopTimer() {
            clearInterval(timerInterval);
            productiveHours = document.getElementById("productiveHoursTimer").innerText;
        }

        function getCurrentTime() {
            const now = new Date();
            return now.toLocaleTimeString();
        }

        // Event listeners for buttons
        document.getElementById("clockInBtn").addEventListener("click", function() {
            fetch("{{ route('clock-in') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
            }).then(response => response.json())
            .then(data => {
                if (data.message === 'Clock in successful') {
                    startTimer();
                    document.getElementById("clockInTime").innerText = `Time: ${getCurrentTime()}`;

                }
            });
        });

        document.getElementById("clockOutBtn").addEventListener("click", function() {
            fetch("{{ route('clock-out') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
            }).then(response => response.json())
            .then(data => {
                if (data.message === 'Clock out successful') {
                    stopTimer();
                    document.getElementById("clockOutTime").innerText = `Time: ${getCurrentTime()}`;
                }
            });
        });

        document.getElementById("productiveHoursBtn").addEventListener("click", function() {
            // Save productive hours to database via AJAX request
            fetch("{{ route('save-productive-hours') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ productiveHours: productiveHours }),
            }).then(response => response.json())
            .then(data => {
                // Handle response as needed
            });
        });
    </script>
@stop
