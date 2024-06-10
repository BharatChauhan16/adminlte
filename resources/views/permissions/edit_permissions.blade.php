@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Edit Permission:</h1>
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
table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
        font-size: 18px;
        text-align: left;
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.15);
    }
    
    thead tr {
        background-color: #009879;
        color: #ffffff;
        text-align: left;
        font-weight: bold;
    }
    
    th, td {
        padding: 12px 15px;
    }
    
    tbody tr {
        border-bottom: 1px solid #dddddd;
    }
    
    tbody tr:nth-of-type(even) {
        background-color: #f3f3f3;
    }
    
    tbody tr:nth-of-type(odd) {
        background-color: #ffffff;
    }
    
    tbody tr:hover {
        background-color: #f1f1f1;
        cursor: pointer;
    }
    
    tbody tr td {
        color: #333;
    }
 </style>
    

<div class=" mt-1 container">
    {{-- <form action="#" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="email">User Email</label>
            <input type="email" id="email" name="email" class="form-control" value="{{ $users->email }}" readonly>
        </div>

             <div class="form-group">
                <label for="employeecode">Employee Code</label>
                <input type="text" id="employee_code" name="employee_code" class="form-control" value="CW000{{ $users->id }}" readonly>
            </div> 
    </form>  --}}


    <div class="mt-1 form-container">
        <form action="#" method="post" enctype="multipart/form-data">
            @csrf
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Select</th>
                        <th>Title</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($permissions as $permission)
                        <tr>
                            <td><input type="checkbox" name="permission[]" value="{{ $permission->id }}"></td>
                            <td>{{ $permission->title }}</td>
                            <td>{{ $permission->description }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
              
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



