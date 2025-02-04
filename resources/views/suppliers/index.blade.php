@extends('adminlte::page')

@section('title', 'Belluzi')

@section('content_header')
    <h1>Lista de Fornecedores</h1>
@stop

@section('content')
    <form method="GET" action="{{ route('suppliers.index') }}" id="filter-form">
        <div class="row">
            <div class="col-md-3 form-group">
                <label for="type">Tipo</label>
                <select name="type" id="type" class="form-control">
                    <option value="">Selecione</option>
                    <option value="Fornecedor" {{ request('type') == 'Fornecedor' ? 'selected' : '' }}>Fornecedor</option>
                    <option value="Distribuidor" {{ request('type') == 'Distribuidor' ? 'selected' : '' }}>Distribuidor</option>
                </select>
            </div>

            <div class="col-md-3 form-group">
                <label for="name">Nome Completo</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ request('name') }}">
            </div>

            <div class="col-md-3 form-group">
                <label for="fantasy_name">Nome Fantasia</label>
                <input type="text" name="fantasy_name" id="fantasy_name" class="form-control" value="{{ request('fantasy_name') }}">
            </div>

            <div class="col-md-2 form-group d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100">Filtrar</button>
            </div>
        </div>
    </form>

    <table class="table table-bordered table-striped" id="tableList">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Tipo</th>
                <th>Nome Completo</th>
                <th>Nome Fantasia</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($suppliers as $supplier)
            <tr>
                <td>{{ $supplier->id }}</td>
                <td>{{ $supplier->type }}</td>
                <td>{{ $supplier->full_name }}</td>
                <td>{{ $supplier->fantasy_name }}</td>
                <td>
                    <a href="{{ route('suppliers.edit', $supplier->id) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('suppliers.destroy', $supplier->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $suppliers->links() }}
@stop

@section('css')
    <link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet">
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('js/paginacao.js') }}"></script>
@stop
