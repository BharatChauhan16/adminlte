@extends('adminlte::page')

@section('title', 'Contriwhiz-users')

@section('content_header')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<div class="container mt-3">
    <div class="header">
        <h1 class="mb-0">Users:</h1>
    </div>
    <div class="actions">
        <a href="{{ route ('create-user') }}" target="_blank" class="action-btn">
            <button class="btn btn-success">Create User</button>
        </a>
        <a href="{{ route ('add-permission') }}" target="_blank" class="action-btn">
            <button class="btn btn-success">Add Permissions</button>
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
    .container {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
}

.header {
    margin-right: auto; /* Push to the left */
}

.actions {
    display: flex;
    justify-content: flex-end;
}

.action-btn {
    margin-left: 10px; /* Add some space between buttons */
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
    <div class="mt-3 form-container">

        @if(session('edituser'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('edituser') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        @if(session('adduser'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('adduser') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
<table >
    <thead>
        <tr>
            {{-- <th>ID</th> --}}
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
                <tr>
                    {{-- <td>{{ $key + 1}}</td> --}}
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role }}</td>
                    <td class="text-right">
                        <a href="{{ route('edit-user', ['id' => $user->id]) }}" target="_blank" class="btn btn-sm btn-primary ">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="{{ route('edit-permissions', ['id' => $user->id]) }}" target="_blank" class="btn btn-sm btn-secondary">
                            <i class="fas fa-key"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
    </tbody>
</table>
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