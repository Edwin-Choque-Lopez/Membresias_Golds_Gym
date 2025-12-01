@extends('adminlte::page')

@section('title', 'Clientes')

@section('content_header')
    <nav aria-label="breadcrumb" style="font-size: 15pt">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/home')}}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{url('/clientmemberships/form')}}">Venta de Membresias</a></li>
            <li class="breadcrumb-item active" aria-current="page">Formulario de Venta</li>
        </ol>
    </nav>
    <hr>
@stop

@section('content')
    <div class="row d-flex justify-content-center align-items-center" >
        <div class="col-sm-10 col-md-8 col-lg-12">
            <div class="card card-outline card-info">
                <div class="card-header">
                    <h3 class="card-title">Rellene los Campos</h3>
                <!-- /.card-tools -->
                </div>
              <!-- /.card-header -->
                <div class="card-body">
                    <form action="{{url('/clientmemberships/createindividualmembership')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Nombre de la Membresia</label>
                                            <select name="membership_id" class="form-control" readonly>
                                                <option value="{{ $membership['id'] }}">{{ $membership['name'] }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Meses de duracion</label>
                                            <input type="text" name="duration_months" value="{{$membership['duration_months']}}" class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Precio</label>
                                            <input type="text" name="price" value="{{$membership['price']}}" class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Clientes</label>
                                            <select name="client_id" class="form-control" id="">
                                                @foreach ($clients as $client)
                                                    <option value="{{ $client->id }}">
                                                        Nombre: {{ $client->name }} &nbsp;&nbsp;&nbsp;--&nbsp;&nbsp;&nbsp; C.I: {{ $client->ci }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Fecha de Inicio</label>
                                            <input type="date" name="fecha_de_inicio" class="form-control" value="{{$start_date->format('Y-m-d')}}">
                                            @error('fecha_de_inicio')
                                                <small style="color: red;">* {{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Fecha Final</label>
                                            <input type="date" name="fecha_final" value="{{$end_date->format('Y-m-d')}}" class="form-control">
                                            @error('fecha_final')
                                                <small style="color: red;">* {{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="">Pago</label>
                                            <input type="number" name="pago" value="{{old('pago')}}" step="0.01" min="0" class="form-control">
                                            @error('pago')
                                                <small style="color: red;">* {{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="">&nbsp;</label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" value="1" name="tipo_pago" checked>
                                                <label class="form-check-label" for="radioDefault1"> Pago Completo</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" value="0" name="tipo_pago" >
                                                <label class="form-check-label" for="radioDefault2">Pago Incompleto</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Estado de pago</label>
                                            <select name="estado_pago" class="form-control" id="">
                                                @foreach ($payment_methods as $payment_method)
                                                    <option value="{{ $payment_method->id }}">
                                                        {{$payment_method->name}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Estado de la membresia</label>
                                            <select name="estado_membresia" class="form-control" id="">
                                                @foreach ($membership_status as $membership_statu)
                                                    <option value="{{ $membership_statu->id }}">
                                                        {{ $membership_statu->name }}                                                    </option>
                                                @endforeach
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
                                    <button type="submit" class="btn btn-info">Registrar</button>
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