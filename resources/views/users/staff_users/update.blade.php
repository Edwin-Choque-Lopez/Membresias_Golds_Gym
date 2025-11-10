@extends('adminlte::page')

@section('title', 'Personal')

@section('content_header')
    <nav aria-label="breadcrumb" style="font-size: 15pt">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/home')}}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{url('/staff')}}">Personal</a></li>
            <li class="breadcrumb-item active" aria-current="page">Formulario de Actualización de Datos</li>
        </ol>
    </nav>
    <hr>
@stop

@section('content')
    <div class="row d-flex justify-content-center align-items-center" >
        <div class="col-md-12">
            <div class="card card-outline card-warning">
                <div class="card-header">
                    <h3 class="card-title">Modificar los Campos Necesarios</h3>
                <!-- /.card-tools -->
                </div>
              <!-- /.card-header -->
                <div class="card-body">
                    <form action="{{route('staff.update',$result['person_id'])}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Rol</label>
                                            <select name="rol" class="form-control" id="">
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->id }}" {{ $role->id == $result['rol']['rol_id'] ? 'selected' : '' }}>
                                                        {{ $role->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">C.I.</label>
                                            <input type="text" name="ci" value="{{$result['ci']}}" class="form-control">
                                            @error('ci')
                                                <small style="color: red;">* {{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label for="">Nombre Completo</label>
                                            <input type="text" name="nombre" value="{{$result['nombre']}}" class="form-control">
                                            @error('nombre')
                                                <small style="color: red;">* {{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Genero</label>
                                            <select name="genero" class="form-control" id="">
                                                @if($result['genero']=='M')
                                                    <option value="M" selected>Masculino</option>
                                                    <option value="F">Femenino</option>
                                                    <option value="O">Otro</option>
                                                @elseif($result['genero']=='F')
                                                    <option value="M">Masculino</option>
                                                    <option value="F" selected>Femenino</option>
                                                    <option value="O">Otro</option>
                                                @else
                                                    <option value="M">Masculino</option>
                                                    <option value="F">Femenino</option>
                                                    <option value="O" selected>Otro</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Telefono</label>
                                            <input type="text" name="telefono" value="{{$result['telefono']}}" class="form-control" >
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
                                                <input type="email" name="correo" value="{{$result['usuario']['email']}}" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                                            </div>
                                            @error('correo')
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
                                    <center><output id="list">
                                        <img src="{{$result['usuario']['photo'] ? asset($result['usuario']['photo']) : asset('/storage/profile_pictures/default.jpg')}}" alt="" class="ajustar_imagen">
                                    </output></center>                                                                    
                                </div>
                            </div>
                        </div> 
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <a href="{{url('/staff')}}" class="btn btn-secondary">Cancelar</a>
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
    <script>
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