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
                <button id="calculateproductiveHoursBt" class="btn btn-primary">Calculate Productive Hours</button>
            </div>
        </div>
    </div>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#breakModal" style="margin-top: 10px;">
        <i class="fas fa-plus-circle mr-2"></i> Add Break
    </button>
    
    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>Start Time</th>
                <th>Break Reason</th>
                <th>Break Time</th>
                <th>End Time</th>
                <th>End</th>
            </tr>
        </thead>
        <tbody id="breaksTableBody">
            <!-- Dynamic rows will be added here -->
        </tbody>
    </table>
    
    <div class="modal fade" id="breakModal" tabindex="-1" role="dialog" aria-labelledby="breakModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="breakModalLabel">Add Break</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                    <form id="addBreakForm">
                        <div class="form-group">
                            <label for="breakReason">Break Reason</label>
                            <input type="text" class="form-control" id="breakReason" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Take Break</button>
                    </form>
                   
                </div>
            </div>
        </div>
    </div>
    {{-- @include('modals.add_break_modal') --}}
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


        // Handle all break managment system
        // JavaScript for handling modal, stopwatch, and AJAX requests
$(document).ready(function() {
    // Event listener for the "Take Break" form submission
    $('#addBreakForm').on('submit', function(e) {
        e.preventDefault();
        let reason = $('#breakReason').val();

        $.ajax({
            url: '{{ route('save.break') }}',
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            data: { reason: reason },
            success: function(response) {
                let startTime = new Date(response.start_time).toLocaleTimeString();
                let breakId = response.id;

                // Construct new row for the breaks table
                let newRow = `<tr data-break-id="${breakId}">
                                <td>${startTime}</td>
                                <td>${response.reason}</td>
                                <td class="break-time">00:00:00</td>
                                <td></td>
                                <td><button class="btn btn-danger end-break-btn">End Break</button></td>
                              </tr>`;

                $('#breaksTableBody').append(newRow);

                // Start stopwatch for this break
                startStopwatch(breakId);
                
                $('#breakModal').modal('hide');
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
            }
        });
    });

    // Function to start stopwatch for a break
    function startStopwatch(breakId) {
        let startTime = new Date();
        let interval = setInterval(function() {
            let currentTime = new Date();
            let elapsedTime = new Date(currentTime - startTime);
            let hours = elapsedTime.getUTCHours();
            let minutes = elapsedTime.getUTCMinutes();
            let seconds = elapsedTime.getUTCSeconds();
            let timeString = `${hours}:${minutes}:${seconds}`;
            $(`tr[data-break-id="${breakId}"] .break-time`).text(timeString);
        }, 1000);

        // Event listener for "End Break" button
        $(`tr[data-break-id="${breakId}"] .end-break-btn`).on('click', function() {
            clearInterval(interval);

            $.ajax({
                url: '{{ route('end.break', '') }}/' + breakId,
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(response) {
                    let endTime = new Date(response.end_time).toLocaleTimeString();
                    $(`tr[data-break-id="${breakId}"] td:nth-child(4)`).text(endTime);
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        });
    }
});
// Existing code...
        
        // Add this function to calculate and display productive hours
        function calculateProductiveHours() {
            fetch("{{ route('calculate-productive-hours') }}", {
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
            }).then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById("productiveHoursTimer").innerText = data.productiveHours;
                } else {
                    console.error('Error calculating productive hours:', data.error);
                }
            });
        }

        // Event listener for the "Calculate Productive Hours" button
        document.getElementById("calculateproductiveHoursBt").addEventListener("click", function() {
            calculateProductiveHours();
        });
    
    </script>
@stop