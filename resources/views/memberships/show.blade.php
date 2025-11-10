@extends('adminlte::page')

@section('title', 'Membresias')

@section('content_header')
    <nav aria-label="breadcrumb" style="font-size: 15pt">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/home')}}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{url('/memberships')}}">Membresias</a></li>
            <li class="breadcrumb-item active" aria-current="page">Información</li>
        </ol>
    </nav>
    <hr>
@stop

@section('content')
    <div class="row d-flex justify-content-center align-items-center" >
        <div class="col-sm-10 col-md-8 col-lg-12">
            <div class="card card-outline card-success">
                <div class="card-header">
                    <h3 class="card-title">Información de la Membresia</h3>
                <!-- /.card-tools -->
                </div>
              <!-- /.card-header -->
                <div class="card-body">
                    <form>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Nombre de la membresia</label>
                                            <input type="text" name="nombre" value="{{$membership['name']}}" class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Tipo de membresia</label>
                                            <div style="display: flex; justify-content: left; align-items: left; gap: 8px; height: 100%;">
                                                @php
                                                    $isGroup = $membership['is_group'];
                                                @endphp

                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="radioDisabled" id="radioDisabled" {{ !$isGroup ? 'checked' : '' }} disabled>
                                                    <label class="form-check-label" for="radioDisabled">
                                                        <i class="fas fa-user"></i> Personal
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" value="1" name="tipo" {{ $isGroup ? 'checked' : '' }} disabled>
                                                    <label class="form-check-label" for="radioDefault2">
                                                        <i class="fas fa-users"></i> Grupal
                                                    </label>
                                                </div>   
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Cantidad de meses</label>
                                            <input type="number" name="meses" value="{{$membership['duration_months']}}" class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Precio</label>
                                            <input type="number" name="precio" value="{{$membership['price']}}" step="0.01" min="0" class="form-control" readonly>
                                        </div>
                                    </div>
                                </div>   
                            </div>
                            <div class="col-md-6">
                                <div class="form-group w-100">
                                    <label for="">Descripción</label>
                                    <div class="border rounded p-3 bg-light">
                                        {!! $membership['description'] !!}
                                    </div>
                                </div>
                            </div>
                        </div> 
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <a href="{{url('/home')}}" class="btn btn-secondary">Ir al inicio</a>
                                    <a href="{{url('/memberships')}}" class="btn btn-success">Regresar</a>
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
@stop

@section('js')
@stop