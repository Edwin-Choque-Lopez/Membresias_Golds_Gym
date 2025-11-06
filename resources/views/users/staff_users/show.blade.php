@extends('adminlte::page')

@section('title', 'Personal')

@section('content_header')
    <nav aria-label="breadcrumb" style="font-size: 15pt">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/home')}}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{url('/staff')}}">Personal</a></li>
            <li class="breadcrumb-item active" aria-current="page">Información del Personal</li>
        </ol>
    </nav>
    <hr>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-success">
                <div class="card-header">
                    <h3 class="card-title">Datos del personal</h3>
                <!-- /.card-tools -->
                </div>
              <!-- /.card-header -->
                <div class="card-body">
                    <form>
                        <div class="row">
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Rol</label>
                                            <input type="text" value="{{$result['rol']['rol_nombre']}}" class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">C.I.</label>
                                            <input type="text" value="{{$result['ci']}}" class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label for="">Nombre Completo</label>
                                            <input type="text" value="{{$result['nombre']}}" class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Genero</label>
                                            @if($result['genero']=='M')
                                                <input type="text" value="Masculino" class="form-control" readonly>
                                            @elseif($result['genero']=='F')
                                                <input type="text" value="Femenino" class="form-control" readonly>
                                            @else
                                                <input type="text" value="Otro" class="form-control" readonly>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Telefono</label>
                                            <input type="text" value="{{$result['telefono']}}" class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Correo</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">@</span>
                                                <input type="email" value="{{$result['usuario']['email']}}" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Fecha de Registro</label>
                                            <input type="date" value="{{$result['registro']}}" class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Hora de Registro</label>
                                            <input type="time" value="{{$result['registro_hora']}}" class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Fecha de Actualizacion </label>
                                            <input type="date" value="{{$result['actualizado']}}" class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Hora de Actualizacion</label>
                                            <input type="time" value="{{$result['actualizado_hora']}}" class="form-control" readonly>
                                        </div>
                                    </div>
                                </div>   
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Fotografia</label>
                                    <center><output id="list">
                                        <img src="{{$result['usuario']['photo'] ? asset($result['usuario']['photo']) : asset('/storage/profile_pictures/default.jpg')}}" alt="" class="ajustar_imagen">
                                    </output></center>                                                                    
                                </div>
                            </div>
                        </div> 
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <a href="{{url('/home')}}" class="btn btn-secondary">Ir a Inicio</a>
                                    <a href="{{url('/staff')}}" class="btn btn-success">Regresar</a>
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
    <style>
        .ajustar_imagen {
            width: 100%;
            height: auto;
            max-height: 250px; /* ajusta según tu diseño */
            object-fit: cover;
            border-radius: 8px; /* opcional, para esquinas redondeadas */
            box-shadow: 0 2px 6px rgba(0,0,0,0.2); /* opcional, para estilo */
        }
        /*.ajustar_imagen {
            width: 90%;
            height: auto;
            border-radius: 5px;
            margin-top: 10px;
        }*/
    </style>
@stop

@section('js')

@stop