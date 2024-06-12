 @extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Edit User:</h1>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CW Add Users</title>
    <link rel="stylesheet" href="resources/css/user.css">
</head>
<body>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
          
            /* justify-content: center;
            align-items: center; */
            height: 100vh;
            margin: 0;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            /* max-width: 500px; */
        }

        div {
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #333;
        }

        input[type="text"], input[type="number"], input[type="file"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"],
.button-container button {
    flex: 1; /* Use flex to distribute space evenly */
    padding: 5px 8px;
    border-radius: 4px;
    font-size: 15px;
    cursor: pointer;
}

.input-container input[type="submit"]:hover,
.button-container button:hover {
    filter: brightness(90%); /* Slight hover effect */
}

/* Add styles for the Add User and Close buttons */
.btn-success {
    background-color: #5cb85c;
    border: none;
    color: white;
}

.btn-success:hover {
    background-color: #4cae4c;
}


.btn-secondary {
    background-color: #6c757d;
    border: none;
    color: white;
}

.btn-secondary:hover {
    background-color: #5a6268;
}

.button-container {
    /* display: flex; */
    justify-content: space-between; /* Arrange buttons with space in between */
    margin-top: 10px; /* Add margin between the buttons and other form elements */
}
    </style>
    

<div class=" mt-3 container">
    <form action="{{ route('edit-user', $addusers->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="email">User Email</label>
            <input type="email" id="email" name="email" class="form-control" value="{{ $addusers->email }}" readonly>
        </div>

             <div class="form-group">
                <label for="employeecode">Employee Code</label>
                <input type="text" id="employee_code" name="employee_code" class="form-control" value="CW000{{ $addusers->id }}" readonly>
            </div> 
            
        
       
    </form> 


    <div class="mt-3 form-container">
        <form action="{{ route ('update-profile') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div>
                <label for="address">Address:</label>
                <input type="text" id="address" name="address" required>
            </div>
            <div>
                <label for="qualifications">Qualifications:</label>
                <input type="text" id="qualifications" name="qualifications" required>
            </div>
            
            <div>
                <label for="employee_code">Employee Code:</label>
                <input type="text" id="employee_code" name="employee_code" value="CW000{{ $addusers->id }}" readonly>
            </div>
            <div>
                <label for="academic_documents">Academic Documents (PDF):</label>
                <input type="file" id="academic_documents" name="academic_documents" accept="application/pdf">
            </div>
            <div>
                <label for="identification_documents">Identification Documents (PDF):</label>
                <input type="file" id="identification_documents" name="identification_documents" accept="application/pdf">
            </div>
            <div>
                <label for="offer_letter">Offer Letter (PDF):</label>
                <input type="file" id="offer_letter" name="offer_letter" accept="application/pdf">
            </div>
            <div>
                <label for="joining_letter">Joining Letter (PDF):</label>
                <input type="file" id="joining_letter" name="joining_letter" accept="application/pdf">
            </div>
            <div>
                <label for="contract">Contract (PDF):</label>
                <input type="file" id="contract" name="contract" accept="application/pdf">
            </div>
            
            <div class="button-container">
                <button type="submit" class="btn btn-success">Update User</button>
                <a href="{{ route ('home')}}">
                    <button type="button" class="btn btn-secondary">Close</button>
                </a>
            </div>
        </form>
    </div>
</div>
</body>
</html>

@stop

@section('content')


@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop
@push('css')

@push('js') 



