@extends('adminlte::page')

@section('title', 'Add-User')

@section('content_header')
    <h1>Add Users:</h1>
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
/* styles.css */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

.form-container {
    width: 100%; 
    max-width: 
    margin: 0; 
    padding: 20px;
    box-sizing: border-box; 
    background-color: #fff; 
    border-radius: 15px;
    box-shadow: 0 0 10px rgba(207, 191, 191, 0.1); 
    box-shadow: 10px 10px 10px 10px rgba(0, 0, 0, 0.1);
}

form {
    display: flex;
    flex-direction: column;
}

label {
    margin-bottom: 5px;
    font-weight: bold;
}

input[type="text"],
input[type="email"],
input[type="password"],
select {
    margin-bottom: 15px;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
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
    <div class="mt-3 form-container">
        <form action="{{ route ('add-users') }}" method="post">
            @csrf
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <label for="role">Role:</label>
            <select id="role" name="role" required>
                <option value="">Select a role</option>
                <option value="admin">Admin</option>
                <option value="editor">Editor</option>
                <option value="viewer">Viewer</option>
            </select>
            
            <div class="button-container">
                <button type="submit" class="btn btn-success">Add User</button>
                <a href="{{ route ('home')}}">
                    <button type="button" class="btn btn-secondary">Close</button>
                </a>
            </div>
            
        </form>
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




