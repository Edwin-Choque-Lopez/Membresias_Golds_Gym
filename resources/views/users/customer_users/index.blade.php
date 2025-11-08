@extends('adminlte::page')

@section('title', 'Clientes')

@section('content_header')
    <nav aria-label="breadcrumb" style="font-size: 15pt">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/home')}}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{url('/clients')}}">Clientes</a></li>
            <li class="breadcrumb-item active" aria-current="page">Lista de Clientes</li>
        </ol>
    </nav>
    <hr>
@stop


@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h1 class="card-title"><b>Clientes Registrados</b></h1>
                <div class="card-tools">
                  <a class="btn btn-primary" href="{{url('/clients/create')}}" role="button">Registrar Nuevo Cliente</a>
                </div>
            </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                        <tr>
                            <th>ID</th>
                            <th>C.I.</th>
                            <th>Nombre</th>
                            <th>Telefono</th>
                            <th>Fecha de registro</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($clients as $client)
                            <tr>
                                <td>{{ $client['id'] }}</td>
                                <td>{{ $client['ci']}}</td>
                                <td>{{ $client['name'] }}</td>
                                <td>{{ $client['phone'] }}</td>
                                <td>{{ $client['created_at']}}</td>
                                <td style="display: flex; justify-content: center; align-items: center; gap: 8px; height: 100%;">
                                <a href="{{route('clients.show',$client['id'])}}" class="btn btn-primary"><i class="far fa-eye"></i></a>
                                <a href="{{route('clients.edit',$client['id'])}}" type="button" class="btn btn-warning"><i class="far fa-edit"></i></a>
                                <form action="{{ route('clients.destroy', $client['id']) }}" method="POST" style="display: inline;" id="form-delete-{{ $client['id'] }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-delete" data-id="{{ $client['id'] }}">
                                        <i class="far fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                            </tr>
                        @endforeach
                    </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
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
                "info": "Mostrando del _START_ a _END_ de _TOTAL_ Clientes",
                "infoEmpty": "Mostrando 0 a 0 de 0 Clietes",
                "infoFiltered": "(Filtrado de _MAX_ total Usuarios)",
                "lengthMenu": "Mostrar _MENU_ Clientes",
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

    document.querySelectorAll('.btn-delete').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault(); // Detiene el envío inmediato

            const id = this.getAttribute('data-id');
            const form = document.getElementById('form-delete-' + id);

            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: "btn btn-success",
                    cancelButton: "btn btn-danger"
                },
                buttonsStyling: false
            });
            swalWithBootstrapButtons.fire({
                title: "¿Estás seguro?",
                text: "¡No podrás revertir esto!",
                icon: "question",
                showCancelButton: true,
                confirmButtonText: "Si, eliminar!",
                cancelButtonText: "No, cancelar!",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                        /*swalWithBootstrapButtons.fire({
                            title: "Deleted!",
                            text: "Your file has been deleted.",
                            icon: "success"
                        });*/
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    swalWithBootstrapButtons.fire({
                        title: "Cancelado",
                        text: "Se ha cancelado la eliminación.",
                        icon: "error"
                    });
                }   
            });

        });
    });
    </script>
@stop