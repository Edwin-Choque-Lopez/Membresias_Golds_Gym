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

            </div>
            <!--Contenido-->
            <div class="card-body" style="display: block;">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>1</th>
                            <th>hola</th>
                            <th>hola2</th>
                            <th>hola3</th>
                        </tr>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Acciones</th>
                        </tr>
                        <tr>
                            <th>1</th>
                            <th>hola</th>
                            <th>hola2</th>
                            <th>hola3</th>
                        </tr>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Acciones</th>
                        </tr>
                         <tr>
                            <th>1</th>
                            <th>hola</th>
                            <th>hola2</th>
                            <th>hola3</th>
                        </tr>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>zzz</th>
                            <th>Acciones</th>
                        </tr>
                        <tr>
                            <th>1</th>
                            <th>yyy</th>
                            <th>hola2</th>
                            <th>hola3</th>
                        </tr>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Acciones</th>
                        </tr>
                        <tr>
                            <th>1</th>
                            <th>hola</th>
                            <th>hola2</th>
                            <th>hola3</th>
                        </tr>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Acciones</th>
                        </tr>
                        <tr>
                            <th>1</th>
                            <th>hola</th>
                            <th>hola2</th>
                            <th>hola3</th>
                        </tr>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Acciones</th>
                        </tr>
                         <tr>
                            <th>1</th>
                            <th>hola</th>
                            <th>hola2</th>
                            <th>hola3</th>
                        </tr>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Acciones</th>
                        </tr>
                        <tr>
                            <th>1</th>
                            <th>hola</th>
                            <th>hola2</th>
                            <th>hola3</th>
                        </tr>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Acciones</th>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

@stop

@section('css')
<style>
    /* Fondo transparente y sin borde en el contenedor */
    #example1_wrapper .dt-buttons {
        background-color: transparent;
        box-shadow: none;
        border: none;
        display: flex;
        justify-content: center; /* Centrar los botones */
        gap: 10px; /* Espaciado entre botones */
        margin-bottom: 15px; /* Separar botones de la tabla */
    }

    /* Estilo personalizado para los botones */
    #example1_wrapper .btn {
        color: #fff; /* Color del texto en blanco */
        border-radius: 4px; /* Bordes redondeados */
        padding: 5px 15px; /* Espaciado interno */
        font-size: 14px; /* TamaÃ±o de fuente */
    }

    /* Colores por tipo de botÃ³n */
    .btn-danger { background-color: #dc3545; border: none; }
    .btn-success { background-color: #28a745; border: none; }
    .btn-info { background-color: #17a2b8; border: none; }
    .btn-warning { background-color: #ffc107; color: #212529; border: none; }
    .btn-default { background-color: #6e7176; color: #212529; border: none; }
</style>
@stop

@section('js')
    <script> 
        $(function () {
        $("#example1").DataTable({
            "pageLength": 5,
            "language": {
                "emptyTable": "No hay información",
                "info": "Mostrando del _START_ a _END_ de _TOTAL_ Usuarios",
                "infoEmpty": "Mostrando 0 a 0 de 0 Usuarios",
                "infoFiltered": "(Filtrado de _MAX_ total Usuarios)",
                "lengthMenu": "Mostrar _MENU_ Usuarios",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscar:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Último",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            },
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            buttons: [
                { text: '<i class="fas fa-copy"></i> COPIAR', extend: 'copy', className: 'btn btn-default' },
                { text: '<i class="fas fa-file-pdf"></i> PDF', extend: 'pdf', className: 'btn btn-danger' },
                { text: '<i class="fas fa-file-csv"></i> CSV', extend: 'csv', className: 'btn btn-info' },
                { text: '<i class="fas fa-file-excel"></i> EXCEL', extend: 'excel', className: 'btn btn-success' },
                { text: '<i class="fas fa-print"></i> IMPRIMIR', extend: 'print', className: 'btn btn-warning' }
            ]
        }).buttons().container().appendTo('#example1_wrapper .row:eq(0)');
    });
    </script>
@stop