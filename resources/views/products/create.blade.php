@extends('adminlte::page')

@section('title', 'Cadastro de Produto')

@section('content_header')
    <h1>Cadastro de Produto</h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Preencha os dados do produto</h3>
    </div>
    <div class="card-body">
        <form action="#" method="POST">
            @csrf
            <div class="row">
                <!-- Nome do Produto -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nome">Nome do Produto</label>
                        <input type="text" class="form-control @error('nome') is-invalid @enderror" id="nome" name="nome" placeholder="Nome do Produto" value="{{ old('nome') }}" required>
                        @error('nome')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- SKU -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="sku">SKU</label>
                        <input type="text" class="form-control @error('sku') is-invalid @enderror" id="sku" name="sku" placeholder="Código SKU" value="{{ old('sku') }}" required>
                        @error('sku')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Quantidade em Estoque -->
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="quantidade">Quantidade</label>
                        <input type="number" class="form-control @error('quantidade') is-invalid @enderror" id="quantidade" name="quantidade" placeholder="Quantidade em Estoque" value="{{ old('quantidade') }}" required>
                        @error('quantidade')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Código de Barras -->
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="codigo_barras">Código de Barras</label>
                        <input type="text" class="form-control @error('codigo_barras') is-invalid @enderror" id="codigo_barras" name="codigo_barras" placeholder="Código de Barras" value="{{ old('codigo_barras') }}" required>
                        @error('codigo_barras')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Preço de Venda -->
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="preco">Preço de Venda</label>
                        <input type="number" class="form-control @error('preco') is-invalid @enderror" id="preco" name="preco" placeholder="Preço do Produto" value="{{ old('preco') }}" step="0.01" required>
                        @error('preco')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Categorias, Marcas, Tipos de Unidade e Fornecedores -->
            <div class="row">
                <!-- Marca -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="marca">Marca do Produto</label>
                        <select class="form-control @error('marca') is-invalid @enderror" id="marca" name="marca" required>
                            <option value="">Selecione a Marca</option>
                            @foreach($brands as $marca)
                                <option value="{{ $marca->id }}">{{ $marca->name }}</option>
                            @endforeach
                        </select>
                        @error('marca')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Tipo de Unidade -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="tipo_unidade">Tipo de Unidade</label>
                        <select class="form-control @error('tipo_unidade') is-invalid @enderror" id="tipo_unidade" name="tipo_unidade" required>
                            <option value="">Selecione o Tipo de Unidade</option>
                            @foreach($unitType as $tipo)
                                <option value="{{ $tipo->id }}">{{ $tipo->name }}</option>
                            @endforeach
                        </select>
                        @error('tipo_unidade')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Categoria do Produto -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="categoria">Categoria do Produto</label>
                        <select class="form-control @error('categoria') is-invalid @enderror" id="categoria" name="categoria" required>
                            <option value="">Selecione a Categoria</option>
                            @foreach($categories as $categoria)
                                <option value="{{ $categoria->id }}">{{ $categoria->name }}</option>
                            @endforeach
                        </select>
                        @error('categoria')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Fornecedor -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="fornecedor">Fornecedor</label>
                        <select class="form-control @error('fornecedor') is-invalid @enderror" id="fornecedor" name="fornecedor" required>
                            <option value="">Selecione o Fornecedor</option>
                            @foreach($suppliers as $fornecedor)
                                <option value="{{ $fornecedor->id }}">{{ $fornecedor->nome }}</option>
                            @endforeach
                        </select>
                        @error('fornecedor')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Switch para selecionar se o produto tem variação -->
            <div class="form-check form-switch mb-3">
                <input class="form-check-input" type="checkbox" role="switch" id="tem_variacao" name="tem_variacao" value="1">
                <label class="form-check-label" for="tem_variacao">Produto com Variação</label>
            </div>


            <!-- Variações -->
            <div class="row" id="variacao-container" style="display: none;">
                <div class="col-md-12">
                    <h4>Variações do Produto</h4>
                    <div class="form-group">
                        <label for="variacao">Selecione a Variação</label>
                        <select class="form-control" id="variacao" name="variacao">
                            <option value="">Selecione a Variação</option>
                            @foreach($productVariations as $variacao)
                                <option value="{{ $variacao->id }}" data-opcoes="{{ json_encode($variacao->opcoes) }}">
                                    {{ $variacao->nome }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Campo para selecionar múltiplas opções -->
                    <div class="form-group" id="opcoes-container" style="display: none;">
                        <label for="opcoes">Selecione as Opções</label>
                        <select class="form-control" id="opcoes" name="opcoes[]" multiple>
                            <!-- As opções serão inseridas dinamicamente aqui -->
                        </select>
                    </div>

                    <!-- Tabela de Variações -->
                    <table id="variacoes" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Imagem</th>
                                <th>Variação</th>
                                <th>Estoque Disponível</th>
                                <th>Preço</th>
                                <th>SKU</th>
                                <th>Código de Barras</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- As linhas de variação serão inseridas aqui via Javascript -->
                        </tbody>
                    </table>
                </div>
            </div>

            
            <div class="form-group">
                <button type="submit" class="btn btn-success">Cadastrar Produto</button>
                <a href="#" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>

@stop

@section('js')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"></link>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

<script>
    $(document).ready(function() {
    // Inicializa a tabela do DataTables
    var table = $('#variacoes').DataTable();

    // Ao selecionar uma variação no select
    $('#variacao').change(function() {
        var variacaoId = $(this).val();
        var opcoes = $(this).find('option:selected').data('opcoes');

        if (variacaoId && opcoes) {
            // Exibe o campo de seleção de opções
            $('#opcoes-container').show();
            $('#opcoes').empty();

            // Preenche as opções do select de opções
            opcoes.forEach(function(opcao) {
                $('#opcoes').append(new Option(opcao.nome, opcao.id));
            });
        } else {
            // Esconde o campo de seleção de opções se nenhuma variação for selecionada
            $('#opcoes-container').hide();
        }
    });

    // Função para adicionar as variações selecionadas à tabela
    $('#opcoes').change(function() {
        var selectedOptions = $(this).val();

        // Limpa a tabela antes de adicionar novas variações
        table.clear();

        // Loop pelas opções selecionadas e adicionar as linhas na tabela
        selectedOptions.forEach(function(opcaoId) {
            // Supondo que você tenha informações sobre cada opção de variação
            var variacaoInfo = getVariacaoInfo(opcaoId); // Função para obter os dados da variação

            var row = [
                `<img src="${variacaoInfo.imagem}" alt="${variacaoInfo.nome}" width="50">`,
                variacaoInfo.nome,
                variacaoInfo.estoque,
                variacaoInfo.preco,
                variacaoInfo.sku,
                variacaoInfo.codigo_barras,
                `<button class="btn btn-danger btn-sm">Excluir</button>`
            ];

            // Adiciona a nova linha na tabela
            table.row.add(row).draw();
        });
    });

    // Função fictícia para obter as informações da variação (você pode substituir por uma chamada AJAX, se necessário)
    function getVariacaoInfo(opcaoId) {
        // Exemplo de dados da variação, você deve ajustar conforme sua estrutura de dados
        var variacoes = @json($productVariations); // Carrega as variações do PHP

        for (var i = 0; i < variacoes.length; i++) {
            var opcoes = variacoes[i].opcoes;
            for (var j = 0; j < opcoes.length; j++) {
                if (opcoes[j].id == opcaoId) {
                    return {
                        imagem: opcoes[j].imagem,
                        nome: opcoes[j].nome,
                        estoque: opcoes[j].estoque,
                        preco: opcoes[j].preco,
                        sku: opcoes[j].sku,
                        codigo_barras: opcoes[j].codigo_barras
                    };
                }
            }
        }

        return {};
    }
});

$(document).ready(function() {
        // Esconde a parte de variações inicialmente
        $('#variacao-container').hide();

        // Função que verifica o estado do switch e exibe a seção de variações
        $('#tem_variacao').change(function() {
            if ($(this).is(':checked')) {
                // Se o switch estiver marcado, mostra a seção de variações
                $('#variacao-container').show();
            } else {
                // Se o switch não estiver marcado, esconde a seção de variações
                $('#variacao-container').hide();
            }
        });

        // Verifica se o switch está marcado ao carregar a página (para manter o estado após o envio de um erro, por exemplo)
        if ($('#tem_variacao').is(':checked')) {
            $('#variacao-container').show();
        }
    });

</script>
@stop
