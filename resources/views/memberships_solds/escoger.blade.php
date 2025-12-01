@extends('adminlte::page')

@section('title', 'venta_de_membresias')

@section('content_header')
    <nav aria-label="breadcrumb" style="font-size: 15pt">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/home')}}">Inicio</a></li>
            <li class="breadcrumb-item active" aria-current="page">Venta de membresias</li>
        </ol>
    </nav>
    <hr>
@stop

@section('content')
    <div class="row d-flex justify-content-center align-items-center" >
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Escoja un tipo de membresia</h3>
                </div>
                <div class="card-body" style="display: block;">
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-info"><i class="fas fa-user"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Membresias Personales</span>
                                    <form action="{{url('/clientmemberships/individualmembership')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                        <div class="row">
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <label>Selecione el tipo de memebresia</label>
                                                    <select name="membership_id" class="form-control">
                                                        @foreach ($individual_plans as $individual_plan)
                                                            <option value="{{$individual_plan['id']}}">{{$individual_plan['name']}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>&nbsp;</label>
                                                    <button type="submit" class="btn btn-info">Selecionar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-success"><i class="fas fa-users"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Membresias Grupales</span>
                                    <form action="{{url('/memberships')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                        <div class="row">
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <label>Selecione el tipo de memebresia</label>
                                                    <select name="" class="form-control">
                                                        @foreach ($grupal_plans as $grupal_plan)
                                                            <option value="{{$grupal_plan['id']}}">{{$grupal_plan['name']}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>&nbsp;</label>
                                                    <button type="submit" class="btn btn-info">Selecionar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    
@stop