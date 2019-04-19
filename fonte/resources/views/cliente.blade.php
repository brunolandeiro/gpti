@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="row justify-content-center">
                <div class="col-md-10"><h2>Cliente</h2></div>
                <div class="col-md-2"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Novo</button></div>
            </div>
            <hr>
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
                            <a href="{{route('get_cliente', ['id' => $cliente->CPF])}}" class="btn btn-success">Editar</a>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal">Excluir</button>
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

@if(isset($selecionado))
    <!-- The Modal NOVO-->
<div class="modal" id="modalUpdate" style="display: block">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Cadastrar Cliente</h4>
          <button type="button" class="close" data-dismiss="modal" id="modalUpdateFechar">&times;</button>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
            <form action="{{route('cliente_cadastrar')}}" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="cpf">CPF:</label>
                    <input type="text" class="form-control{{ $errors->has('cpf') ? ' is-invalid' : '' }}" id="cpf" placeholder="Entre com o cpf" name="cpf" value="{{ $selecionado->CPF }}">
                    @if ($errors->has('cpf'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('cpf') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="nome">Nome:</label>
                    <input type="text" class="form-control{{ $errors->has('nome') ? ' is-invalid' : '' }}" id="nome" placeholder="Entre com o nome" name="nome"  value="{{ $selecionado->NOME }}">
                    @if ($errors->has('nome'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('nome') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="descricao">Descrição:</label>
                    <input type="text" class="form-control{{ $errors->has('descricao') ? ' is-invalid' : '' }}" id="descricao" placeholder="Entre com a descrição" name="descricao"  value="{{ $selecionado->DESCRICAO }}">
                    @if ($errors->has('descricao'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('descricao') }}</strong>
                        </span>
                    @endif
                </div>
                <button type="submit" class="btn btn-success">Editar</button>
            </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endif

<!-- The Modal NOVO-->
<div class="modal" id="myModal" >
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Cadastrar Cliente</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
            <form action="{{route('cliente_cadastrar')}}" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="cpf">CPF:</label>
                    <input type="text" class="form-control{{ $errors->has('cpf') ? ' is-invalid' : '' }}" id="cpf" placeholder="Entre com o cpf" name="cpf" value="{{ old('cpf') }}">
                    @if ($errors->has('cpf'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('cpf') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="nome">Nome:</label>
                    <input type="text" class="form-control{{ $errors->has('nome') ? ' is-invalid' : '' }}" id="nome" placeholder="Entre com o nome" name="nome"  value="{{ old('nome') }}">
                    @if ($errors->has('nome'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('nome') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="descricao">Descrição:</label>
                    <input type="text" class="form-control{{ $errors->has('descricao') ? ' is-invalid' : '' }}" id="descricao" placeholder="Entre com a descrição" name="descricao"  value="{{ old('descricao') }}">
                    @if ($errors->has('descricao'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('descricao') }}</strong>
                        </span>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Cadastrar</button>
            </form>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
