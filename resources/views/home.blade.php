@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    
<div class="container mt-3">
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="mb-0">Welcome</h1>
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
    <p>Welcome to this beautiful admin panel.</p>
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