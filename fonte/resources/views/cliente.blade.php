@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="row justify-content-center">
                <div class="col-md-10"><h2>Cliente</h2></div>
                <div class="col-md-2"><a  href="{{route('cliente', ['id' => 'novo'])}}" class="btn btn-primary">Novo</a></div>
            </div>
            <hr>
            @if($showForm)
            <div class="card">
            <div class="card-header">Formulário de Cliente</div>
            <div class="card-body">
            <form action="{{route('cliente_cadastrar')}}" method="post">
                {{ csrf_field() }}
                <input type="hidden" id="cpfUpdate" name="cpfUpdate" value="{{ isset($selecionado->CPF) ? $selecionado->CPF : '' }}">
                <div class="form-group">
                    <label for="cpf">CPF:</label>
                    <input type="text" class="form-control{{ $errors->has('cpf') ? ' is-invalid' : '' }}" id="cpf" placeholder="Entre com o cpf" name="cpf" value="{{ isset($selecionado->CPF) ? $selecionado->CPF : old('cpf') }}" required>
                    @if ($errors->has('cpf'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('cpf') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="nome">Nome:</label>
                    <input type="text" class="form-control{{ $errors->has('nome') ? ' is-invalid' : '' }}" id="nome" placeholder="Entre com o nome" name="nome"  value="{{ isset($selecionado->NOME) ? $selecionado->NOME : old('nome') }}">
                    @if ($errors->has('nome'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('nome') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="descricao">Descrição:</label>
                    <input type="text" class="form-control{{ $errors->has('descricao') ? ' is-invalid' : '' }}" id="descricao" placeholder="Entre com a descrição" name="descricao"  value="{{ isset($selecionado->DESCRICAO) ? $selecionado->DESCRICAO : old('descricao') }}">
                    @if ($errors->has('descricao'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('descricao') }}</strong>
                        </span>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Salvar</button>
                <a href="{{route('cliente')}}" class="btn btn-default">Fechar</a>
            </form>
            </div>
            </div>
            <br>
            @endif
            <div class="card">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>CPF</th>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($clientes as $cliente)
                    <tr>
                        <td>{{ $cliente->CPF }}</td>
                        <td>{{ $cliente->NOME }}</td>
                        <td>{{ $cliente->DESCRICAO }}</td>
                        <td>
                            <a href="{{route('cliente', ['id' => $cliente->CPF])}}" class="btn btn-success">Editar</a>
                            <a href="{{route('cliente_delete', ['id' => $cliente->CPF])}}" class="btn btn-danger">Deletar</a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <br>
            <div class="row justify-content-center">
                <div>{{ $clientes->links() }}</div>  
            </div>
    </div>
</div>

@endsection
