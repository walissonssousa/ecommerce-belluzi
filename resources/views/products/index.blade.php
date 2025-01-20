@extends('adminlte::page')

@section('title', 'Belluzi')

@section('content_header')
    <h1>Todos os Produtos</h1>
@stop

@section('content')
    <form method="GET" action="{{ route('products.index') }}" id="filter-form">
        <div class="row">
            <div class="col-md-3 form-group">
                <label for="category_id">Categoria</label>
                <select name="category_id" id="category_id" class="form-control">
                    <option value="">Selecione</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3 form-group">
                <label for="brand_id">Marca</label>
                <select name="brand_id" id="brand_id" class="form-control">
                    <option value="">Selecione</option>
                    @foreach($brands as $brand)
                        <option value="{{ $brand->id }}" {{ request('brand_id') == $brand->id ? 'selected' : '' }}>
                            {{ $brand->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3 form-group">
                <label for="supplier_id">Fornecedor</label>
                <select name="supplier_id" id="supplier_id" class="form-control">
                    <option value="">Selecione</option>
                    @foreach($suppliers as $supplier)
                        <option value="{{ $supplier->id }}" {{ request('supplier_id') == $supplier->id ? 'selected' : '' }}>
                            {{ $supplier->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3 form-group">
                <label for="inventory_id">Estoque</label>
                <select name="inventory_id" id="inventory_id" class="form-control">
                    <option value="">Selecione</option>
                    <option value="positivo" {{ request('inventory_id') == 'positivo' ? 'selected' : '' }}>Positivo</option>
                    <option value="negativo" {{ request('inventory_id') == 'negativo' ? 'selected' : '' }}>Negativo</option>
                    <option value="acima_maximo" {{ request('inventory_id') == 'acima_maximo' ? 'selected' : '' }}>Acima do máximo</option>
                    <option value="abaixo_minimo" {{ request('inventory_id') == 'abaixo_minimo' ? 'selected' : '' }}>Abaixo do mínimo</option>
                </select>
            </div>

            <div class="col-md-2 form-group">
                <label for="image_id">Imagem</label>
                <select name="image_id" id="image_id" class="form-control">
                    <option value="">Selecione</option>
                    <option value="1" {{ request('image_id') == '1' ? 'selected' : '' }}>Com Imagem</option>
                    <option value="0" {{ request('image_id') == '0' ? 'selected' : '' }}>Sem Imagem</option>
                </select>
            </div>

            <div class="col-md-2 form-group d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100">Filtrar</button>
            </div>
        </div>
    </form>

    <table class="table table-bordered table-striped" id="tableList">
        <thead class="thead-dark">
            <tr>
                <th>Produto</th>
                <th>Categoria</th>
                <th>Preço(R$)</th>
                <th>Estoque</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category->name }}</td>
                    <td>{{ number_format($product->price, 2, ',', '.') }}</td>
                    <td>{{ $product->inventory ? $product->inventory->quantity : 'N/A' }}</td>
                    <td>
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <a href="{{ route('products.destroy', $product->id) }}" class="btn btn-danger btn-sm">Excluir</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $products->links() }}
@stop

@section('css')
    <link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet">
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('js/paginacao.js') }}"></script>
@stop
