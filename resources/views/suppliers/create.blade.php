@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Cadastrar Fornecedor</h1>

    <form action="{{ route('suppliers.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="type">Tipo</label>
            <select name="type" class="form-control" required>
                <option value="fisica">Pessoa Física</option>
                <option value="juridica">Pessoa Jurídica</option>
            </select>
        </div>
        <div class="form-group">
            <label for="full_name">Nome Completo</label>
            <input type="text" name="full_name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="fantasy_name">Nome Fantasia</label>
            <input type="text" name="fantasy_name" class="form-control">
        </div>
        <div class="form-group">
            <label for="cpf">CPF</label>
            <input type="text" name="cpf" class="form-control">
        </div>
        <div class="form-group">
            <label for="cnpj">CNPJ</label>
            <input type="text" name="cnpj" class="form-control">
        </div>
        <div class="form-group">
            <label for="birth_date">Data de Nascimento</label>
            <input type="date" name="birth_date" class="form-control">
        </div>
        <div class="form-group">
            <label for="registration_code">Código de Registro</label>
            <input type="text" name="registration_code" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="state_registration">Inscrição Estadual</label>
            <input type="text" name="state_registration" class="form-control">
        </div>
        <div class="form-group">
            <label for="municipal_registration">Inscrição Municipal</label>
            <input type="text" name="municipal_registration" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Cadastrar</button>
    </form>
</div>
@endsection
