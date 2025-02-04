@extends('adminlte::page') <!-- Herda o layout do AdminLTE -->

@section('title', 'Lista de Marcas')

@section('content_header')
    <h1>Lista de Marcas</h1>
@stop

@section('content')

    <!-- Botão para abrir o modal -->
    <div class="row mb-3">
        <div class="col-md-12 text-right">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addBrandModal">
                <i class="fas fa-plus"></i> Adicionar Marca
            </button>
        </div>
    </div>

    <form method="GET" action="{{ route('brands.index') }}" id="filter-form">
        <div class="row">
            <div class="col-md-4 form-group">
                <label for="name">Nome da Marca</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Filtrar por nome" value="{{ request('name') }}">
            </div>

            <div class="col-md-2 form-group d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100">Filtrar</button>
            </div>
        </div>
    </form>

    <table id="tableList" class="table table-bordered table-striped table-sm">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($brands as $brand)
                <tr>
                    <td>{{ $brand->id}}</td>
                    <td>{{ $brand->name }}</td>
                    <td>
                        <button class="btn btn-warning btn-sm edit-btn" 
                                data-id="{{ $brand->id }}" 
                                data-name="{{ $brand->name }}" 
                                data-description="{{ $brand->description ?? '' }}">
                            Editar
                        </button>
                        <form action="{{ route('brands.destroy', $brand->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $brands->links() }}

    <!-- Modal de Edição de Marca -->
    <div class="modal fade" id="editBrandModal" tabindex="-1" role="dialog" aria-labelledby="editBrandModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editBrandModalLabel">Editar Marca</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('brands.update', ['brand' => ':id']) }}" method="POST" id="editBrandForm">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="edit_name">Nome da Marca</label>
                            <input type="text" name="name" id="edit_name" class="form-control" placeholder="Nome da marca" required>
                        </div>
                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@stop

@section('css')
    <link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet">
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="{{ asset('js/paginacao.js') }}"></script>
    <script>
        $(document).ready(function() {
            // Quando clicar no botão "Editar"
            $('.edit-btn').click(function() {
                var id = $(this).data('id');
                var name = $(this).data('name');
                var description = $(this).data('description');
    
                // Preencher os campos do modal
                $('#editBrandModal').find('#edit_name').val(name);
                $('#editBrandModal').find('#edit_description').val(description);
    
                // Atualizar a URL do formulário com o ID da marca
                var action = $('#editBrandForm').attr('action');
                $('#editBrandForm').attr('action', action.replace(':id', id));
    
                // Exibir o modal
                $('#editBrandModal').modal('show');
            });
        });
    </script>
@stop

<!-- Modal de Adicionar Marca -->
<div class="modal fade" id="addBrandModal" tabindex="-1" role="dialog" aria-labelledby="addBrandModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addBrandModalLabel">Adicionar Nova Marca</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('brands.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Nome da Marca</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Nome da marca" required>
                    </div>
                    <div class="form-group text-right">
                        <button type="submit" class="btn btn-primary">Cadastrar</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

