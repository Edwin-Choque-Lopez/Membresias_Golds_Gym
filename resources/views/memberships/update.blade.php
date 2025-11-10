@extends('adminlte::page')

@section('title', 'Membresias')

@section('content_header')
    <nav aria-label="breadcrumb" style="font-size: 15pt">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/home')}}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{url('/memberships')}}">Membresias</a></li>
            <li class="breadcrumb-item active" aria-current="page">Formulario de Actualizacion</li>
        </ol>
    </nav>
    <hr>
@stop

@section('content')
    <div class="row d-flex justify-content-center align-items-center" >
        <div class="col-sm-10 col-md-8 col-lg-12">
            <div class="card card-outline card-warning">
                <div class="card-header">
                    <h3 class="card-title">Modifique solo los campos necesarios</h3>
                <!-- /.card-tools -->
                </div>
              <!-- /.card-header -->
                <div class="card-body">
                    <form action="{{route('memberships.update',$membership['id'])}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Nombre de la membresia</label>
                                            <input type="text" name="nombre" value="{{$membership['name']}}" class="form-control">
                                            @error('nombre')
                                                <small style="color: red;">* {{$message}}</small>
                                            @enderror
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
                                                    <input class="form-check-input" type="radio" value="0" name="tipo" {{ !$isGroup ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="radioDefault1">
                                                        <i class="fas fa-user"></i> Personal
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" value="1" name="tipo" {{ $isGroup ? 'checked' : '' }}>
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
                                            <input type="number" name="meses" value="{{$membership['duration_months']}}" class="form-control">
                                            @error('meses')
                                                <small style="color: red;">* {{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Precio</label>
                                            <input type="number" name="precio" value="{{$membership['price']}}" step="0.01" min="0" class="form-control">
                                            @error('precio')
                                                <small style="color: red;">* {{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>   
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="form-group">
                                        <label for="">Descripción</label>
                                        @error('descripcion')
                                                <small style="color: red;">* {{$message}}</small>
                                            @enderror
                                        <div class="editor-wrapper">
                                            <textarea id="descripcion" name="descripcion" >{{$membership['description']}}</textarea>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div> 
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <a href="{{url('/memberships')}}" class="btn btn-secondary">Cancelar</a>
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
   .ck.ck-editor {
       width: 100% !important;
   }
   
   .ck-editor__editable {
       width: 100% !important;
       min-height: 300px;
       box-sizing: border-box;
   }
   
   .ck.ck-toolbar {
       flex-wrap: wrap;
   }
   
   @media (max-width: 768px) {
       .ck-editor__editable {
           min-height: 250px;
           padding: 10px;
       }
   }
</style>
@stop

@section('js')
<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
<script>
   ClassicEditor
       .create(document.querySelector('#descripcion'), {
            language: 'es',
           toolbar: {
               items: [
                   'heading', '|',
                   'bold', 'italic', 'underline', 'strikethrough', 'subscript', 'superscript', '|',
                   'link', 'bulletedList', 'numberedList', '|',
                   'outdent', 'indent', '|',
                   'alignment', '|',
                   'blockQuote', 'insertTable', 'mediaEmbed', '|',
                   'undo', 'redo', '|',
                   'fontBackgroundColor', 'fontColor', 'fontSize', 'fontFamily', '|',
                   'code', 'codeBlock', 'htmlEmbed', '|',
                   'sourceEditing'
               ],
               shouldNotGroupWhenFull: true
           },
           
       })
       .then(editor => {
           // Forzar responsive después de crear el editor
           const editorEl = editor.ui.view.element;
           editorEl.style.width = '100%';
           editorEl.querySelector('.ck-editor__editable').style.width = '100%';
       })
       .catch(error => {
           console.error(error);
       });
</script>
@stop