@extends('adminlte::page') <!-- Herda o layout do AdminLTE -->

@section('title', 'Lista de Tipos de Unidade')

@section('content_header')
    <h1>Lista de Tipos de Unidade</h1>
@stop

@section('content')

    <!-- Botão para abrir o modal -->
    <div class="row mb-3">
        <div class="col-md-12 text-right">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addUnitTypeModal">
                <i class="fas fa-plus"></i> Adicionar Tipo de Unidade
            </button>
        </div>
    </div>

    <form method="GET" action="{{ route('unit-types.index') }}" id="filter-form">
        <div class="row">
            <div class="col-md-4 form-group">
                <label for="name">Nome do Tipo de Unidade</label>
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
                <th>Id</th>
                <th>Nome</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($unitTypes as $unitType)
                <tr>
                    <td>{{ $unitType->id }}</td>
                    <td>{{ $unitType->name }}</td>
                    <td>
                        <button class="btn btn-warning btn-sm edit-btn" 
                                data-id="{{ $unitType->id }}" 
                                data-name="{{ $unitType->name }}" 
                                data-description="{{ $unitType->description ?? '' }}">
                            Editar
                        </button>
                        <form action="{{ route('unit-types.destroy', $unitType->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $unitTypes->links() }}

    <!-- Modal de Edição de Tipo de Unidade -->
    <div class="modal fade" id="editUnitTypeModal" tabindex="-1" role="dialog" aria-labelledby="editUnitTypeModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUnitTypeModalLabel">Editar Tipo de Unidade</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('unit-types.update', ['unit_type' => ':id']) }}" method="POST" id="editUnitTypeForm">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="edit_name">Nome do Tipo de Unidade</label>
                            <input type="text" name="name" id="edit_name" class="form-control" placeholder="Nome do tipo de unidade" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_description">Descrição</label>
                            <input type="text" name="description" id="edit_description" class="form-control" placeholder="Descrição do tipo de unidade">
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
                $('#editUnitTypeModal').find('#edit_name').val(name);
                $('#editUnitTypeModal').find('#edit_description').val(description);
    
                // Atualizar a URL do formulário com o ID do tipo de unidade
                var action = $('#editUnitTypeForm').attr('action');
                $('#editUnitTypeForm').attr('action', action.replace(':id', id));
    
                // Exibir o modal
                $('#editUnitTypeModal').modal('show');
            });
        });
    </script>
@stop

<!-- Modal de Adicionar Tipo de Unidade -->
<div class="modal fade" id="addUnitTypeModal" tabindex="-1" role="dialog" aria-labelledby="addUnitTypeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUnitTypeModalLabel">Adicionar Novo Tipo de Unidade</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('unit-types.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Nome do Tipo de Unidade</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Nome do tipo de unidade" required>
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

