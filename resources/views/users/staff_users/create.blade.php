@extends('adminlte::page')

@section('title', 'Personal')

@section('content_header')
    <nav aria-label="breadcrumb" style="font-size: 15pt">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/home')}}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{url('/staff/create')}}">Resgistrar Personal</a></li>
            <li class="breadcrumb-item active" aria-current="page">Formulario</li>
        </ol>
    </nav>
    <hr>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-success">
                <div class="card-header">
                    <h3 class="card-title">Rellene los Campos</h3>
                <!-- /.card-tools -->
                </div>
              <!-- /.card-header -->
                <div class="card-body">
                    <form action="{{url('/staff')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Rol</label>
                                            <select name="rol" class="form-control" id="">
                                                @foreach ($roles as $role)
                                                    <option value="{{$role->id}}">{{$role->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">C.I.</label>
                                            <input type="text" name="ci" value="{{old('ci')}}" class="form-control">
                                            @error('ci')
                                                <small style="color: red;">* {{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label for="">Nombre Completo</label>
                                            <input type="text" name="nombre" value="{{old('nombre')}}" class="form-control">
                                            @error('nombre')
                                                <small style="color: red;">* {{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Genero</label>
                                            <select name="genero" class="form-control" id="">
                                                    <option value="M">Masculino</option>
                                                    <option value="F">Femenino</option>
                                                    <option value="O">Otro</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Telefono</label>
                                            <input type="text" name="telefono" value="{{old('telefono')}}" class="form-control" >
                                            @error('telefono')
                                                <small style="color: red;">* {{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Correo</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">@</span>
                                                <input type="email" name="correo" value="{{old('correo')}}" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                                            </div>
                                            @error('correo')
                                                <small style="color: red;">* {{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="password">Contraseña</label>
                                            <div style="display: flex; align-items: center; width: 100%;">
                                                <input type="password" name="contraseña" id="password" class="form-control" style="flex-grow: 1;">
                                                <button type="button" onclick="Password()" style="background: none; border: none; cursor: pointer;">
                                                    <i id="icon_password" class="fas fa-eye-slash"></i>
                                                </button>
                                            </div>
                                            @error('contraseña')
                                                <small style="color: red;">* {{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="password">Contraseña</label>
                                            <div style="display: flex; align-items: center; width: 100%;">
                                                <input type="password" name="contraseña_confirmation" id="password_confirmation" class="form-control" style="flex-grow: 1;">
                                                <button type="button" onclick="Password_Confirmation()" style="background: none; border: none; cursor: pointer;">
                                                    <i id="icon_confirmation" class="fas fa-eye-slash"></i>
                                                </button>
                                            </div>
                                            @error('contraseña_confirmation')
                                                <small style="color: red;">* {{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>   
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Fotografia</label>
                                    <input type="file" name="fotografia" id="file" class="form-control">
                                    @error('fotografia')
                                            <small style="color: red;">* {{$message}}</small>
                                    @enderror  
                                    <center><output id="list"></output></center>                                                                    
                                </div>
                            </div>
                        </div> 
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <a href="{{url('miembros')}}" class="btn btn-secondary">Cancelar</a>
                                    <button type="submit" class="btn btn-primary">Registrar</button>
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
    <script>
        function Password() {
            var input = document.getElementById("password");
            var icon = document.getElementById("icon_password");
            if (input.type === "password") {
                input.type = "text";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            } else {
                input.type = "password";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            }
        }
        function Password_Confirmation() {
            var input_confirmation = document.getElementById("password_confirmation");
            var icon_confirmation = document.getElementById("icon_confirmation");
            if (input_confirmation.type === "password") {
                input_confirmation.type = "text";
                icon_confirmation.classList.remove("fa-eye-slash");
                icon_confirmation.classList.add("fa-eye");
            } else {
                input_confirmation.type = "password";
                icon_confirmation.classList.remove("fa-eye");
                icon_confirmation.classList.add("fa-eye-slash");
            }
        }
        function archivo(evt){
            var files = evt.target.files;
            //obtenemos la imagen del campo "file".
            for (var i=0, f; f = files[i]; i++){
                //solo admitimos imagenes.
                if (!f.type.match('image.*')){
                    continue;
                }
                var reader = new FileReader();
                reader.onload = (function (theFile){
                    return function (e){
                    //insertamos la imagen
                    document.getElementById("list").innerHTML = ['<img class="thumb thumbnail" src="',e.target.result,'"width="90%" title="', escape(theFile.name),'"/>'].join('');
                    };
                }) (f);
                reader.readAsDataURL(f);
            }
        }
        document.getElementById('file').addEventListener('change',archivo, false);
    </script>
@stop