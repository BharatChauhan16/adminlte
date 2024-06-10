@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    
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
.container {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
}

.header {
    margin-right: auto; 
}

.actions {
    display: flex;
    justify-content: flex-end;
}

.action-btn {
    margin-left: 10px; 
}

</style>
    <p>Welcome to this beautiful admin panel.</p>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    <link rel="stylesheet" href="resources/css/user.css">
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop
@push('css')

@push('js')