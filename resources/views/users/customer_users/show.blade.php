@extends('adminlte::page')

@section('title', 'Clientes')

@section('content_header')
    <nav aria-label="breadcrumb" style="font-size: 15pt">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/home')}}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{url('/clients')}}">Cientes</a></li>
            <li class="breadcrumb-item active" aria-current="page">Informacion del Cliente</li>
        </ol>
    </nav>
    <hr>
@stop

@section('content')
    <div class="row d-flex justify-content-center align-items-center" >
        <div class="col-sm-10 col-md-9 col-lg-10">
            <div class="card card-outline card-success">
                <div class="card-header">
                    <h3 class="card-title">Datos del cliente</h3>
                <!-- /.card-tools -->
                </div>
              <!-- /.card-header -->
                <div class="card-body">
                    <form>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">C.I.</label>
                                            <input type="text" value="{{$client['ci']}}" class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Telefono</label>
                                            <input type="text" value="{{$client['phone']}}" class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label for="">Nombre Completo</label>
                                            <input type="text" value="{{$client['name']}}" class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Genero</label>
                                            @if ($client['gender']=='M')
                                                <input type="text" value="Masculino" class="form-control" readonly>
                                            @elseif ($client['gender']=='F')
                                                <input type="text" value="Femenino" class="form-control" readonly>
                                            @else
                                                <input type="text" value="Otro" class="form-control" readonly>      
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Fecha de Creacion</label>
                                            <input type="text" value="{{$client['created_at_date']}}" class="form-control" readonly>   
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Hora de Creacion</label>
                                            <input type="text" value="{{$client['created_at_time']}}" class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Fecha de Modificacion</label>
                                            <input type="text" value="{{$client['updated_at_date']}}" class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Hora de Modificacion</label>
                                            <input type="text" value="{{$client['updated_at_time']}}" class="form-control" readonly>
                                        </div>
                                    </div>
                                </div>   
                            </div>
                        </div> 
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <a href="{{url('/home')}}" class="btn btn-secondary">Ir al Inicio</a>
                                    <a href="{{url('/clients')}}" class="btn btn-success">Regresar</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
@stop