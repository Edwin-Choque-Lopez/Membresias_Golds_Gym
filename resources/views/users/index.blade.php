@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
    <nav aria-label="breadcrumb" style="font-size: 15pt">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/home')}}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{url('/users')}}">Usuarios</a></li>
            <li class="breadcrumb-item active" aria-current="page">Lista de usuarios</li>
        </ol>
    </nav>
    <hr>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h1 class="card-title"><b>Usuarios Registrados</b></h1>
                <div class="card-tools">
                  <a class="btn btn-primary" href="" role="button">Registrar Nuevo Usuario</a>
                </div>
                <!-- /.card-tools -->
            </div>
              <!-- /.card-header -->
            <div class="card-body" style="display: block;">
                The body of the card
            </div>
              <!-- /.card-body -->
        </div>
    </div>
</div>

@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop