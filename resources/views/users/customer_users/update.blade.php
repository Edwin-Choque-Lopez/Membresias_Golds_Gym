@extends('adminlte::page')

@section('title', 'Clientes')

@section('content_header')
    <nav aria-label="breadcrumb" style="font-size: 15pt">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/home')}}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{url('/clients')}}">Cientes</a></li>
            <li class="breadcrumb-item active" aria-current="page">Formulario de Actualización de Datos</li>
        </ol>
    </nav>
    <hr>
@stop

@section('content')
    <div class="row d-flex justify-content-center align-items-center" >
        <div class="col-sm-10 col-md-8 col-lg-6">
            <div class="card card-outline card-warning">
                <div class="card-header">
                    <h3 class="card-title">Modificar los Campos Necesarios</h3>
                <!-- /.card-tools -->
                </div>
              <!-- /.card-header -->
                <div class="card-body">
                    <form action="{{route('clients.update',$client['id'])}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">C.I.</label>
                                            <input type="text" name="ci" value="{{$client['ci']}}" class="form-control">
                                            @error('ci')
                                                <small style="color: red;">* {{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Telefono</label>
                                            <input type="text" name="telefono" value="{{$client['phone']}}" class="form-control" >
                                            @error('telefono')
                                                <small style="color: red;">* {{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label for="">Nombre Completo</label>
                                            <input type="text" name="nombre" value="{{$client['name']}}" class="form-control">
                                            @error('nombre')
                                                <small style="color: red;">* {{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Genero</label>
                                            <select name="genero" class="form-control" id="">
                                                @if ($client['gender']=='M')
                                                    <option value="M">Masculino</option>
                                                    <option value="F">Femenino</option>
                                                    <option value="O">Otro</option>
                                                @elseif ($client['gender']=='F')
                                                    <option value="F">Femenino</option>
                                                    <option value="M">Masculino</option>
                                                    <option value="O">Otro</option>
                                                @else
                                                    <option value="O">Otro</option>
                                                    <option value="M">Masculino</option>
                                                    <option value="F">Femenino</option>
                                                         
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>   
                            </div>
                        </div> 
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <a href="{{url('/clients')}}" class="btn btn-secondary">Cancelar</a>
                                    <button type="submit" class="btn btn-warning">Actualizar</button>
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