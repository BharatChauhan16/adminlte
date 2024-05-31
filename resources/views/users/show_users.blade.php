@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    
<div class="container mt-3">
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="mb-0">Users:</h1>
        <a href="{{ route ('create-user') }}" target="_blank">
        <button class="btn btn-success" >Create User</button>
    </a>
    </div>
</div>
    {{-- <h1>Users</h1>
    <div class=" mb-1 add-user-btn d-flex justify-content-end">
       <a href="{{ route ('create-user') }}">
          <button type="button" class="btn btn-success">Create User</button>
        </a>
    </div> --}}
@stop

@section('content')
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f0f0f0;
        
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
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
<table >
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $key => $user)
                <tr>
                    <td>{{ $key + 1}}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role }}</td>
                </tr>
            @endforeach
    </tbody>
</table>
    {{-- <p>Welcome to this beautiful admin panel.</p> --}}
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop
@push('css')

@push('js')