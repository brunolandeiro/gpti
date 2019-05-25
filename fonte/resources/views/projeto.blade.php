@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="row justify-content-center">
                <div class="col-md-10"><h2>Projeto</h2></div>
                <div class="col-md-2"><a  href="{{route('projeto', ['id' => 'novo'])}}" class="btn btn-primary">Novo</a></div>
            </div>
            <hr>
            @if($showForm)
            <div class="card">
            <div class="card-header">Formulário de Projeto</div>
            <div class="card-body">
            <form action="{{route('projeto_cadastrar')}}" method="post">
                {{ csrf_field() }}
                <input type="hidden" id="cod_projeto_update" name="cod_projeto_update" value="{{ isset($selecionado->cod_projeto) ? $selecionado->cod_projeto : '' }}">
                <div class="form-group">
                    <label for="cod_projeto">Código:</label>
                    <input type="text" class="form-control{{ $errors->has('cod_projeto') ? ' is-invalid' : '' }}" id="cod_projeto" placeholder="Entre com o cod_projeto" name="cod_projeto" value="{{ isset($selecionado->cod_projeto) ? $selecionado->cod_projeto : old('cod_projeto') }}" required>
                    @if ($errors->has('cod_projeto'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('cod_projeto') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="nome">Nome:</label>
                    <input type="text" class="form-control{{ $errors->has('nome') ? ' is-invalid' : '' }}" id="nome" placeholder="Entre com o nome" name="nome"  value="{{ isset($selecionado->nome) ? $selecionado->nome : old('nome') }}">
                    @if ($errors->has('nome'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('nome') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="descricao">Descrição:</label>
                    <input type="text" class="form-control{{ $errors->has('descricao') ? ' is-invalid' : '' }}" id="descricao" placeholder="Entre com a descrição" name="descricao"  value="{{ isset($selecionado->descricao) ? $selecionado->descricao : old('descricao') }}">
                    @if ($errors->has('descricao'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('descricao') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="cpf">Cliente:</label>
                    <select  class="form-control" id="cpf" name="cpf" >
                        <option value='' selected disabled>Selecione um Cliente</option>
                            @foreach($clientes as $cliente)
                            @if($selecionado->cpf == $cliente->CPF)
                                <option value='{{$cliente->CPF}}' selected>{{$cliente->NOME}}</option>
                            @else
                                <option value='{{$cliente->CPF}}'>{{$cliente->NOME}}</option>
                            @endif
                            @endforeach
                    </select>
                    @if ($errors->has('cpf'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('cpf') }}</strong>
                        </span>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Salvar</button>
                <a href="{{route('projeto')}}" class="btn btn-default">Fechar</a>
            </form>
            </div>
            </div>
            <br>
            @endif
            <div class="card">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($projetos as $projeto)
                    <tr>
                        <td>{{ $projeto->cod_projeto }}</td>
                        <td>{{ $projeto->nome }}</td>
                        <td>{{ $projeto->descricao }}</td>
                        <td>{{ $projeto->cpf }}</td>
                        <td>
                        <!-- Button to Open the Modal -->
                            <button type="button" class="btn btn-default" data-toggle="modal" 
                                data-target="#{{$projeto->cod_projeto}}">Master Detail
                            </button>
                            <!-- The Modal -->
                            <div class="modal fade" id="{{$projeto->cod_projeto}}">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">Master Detail - {{$projeto->nome}}</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        <h5>Fase</h5>
                                        <table class="table table-hover">
                                            <thead>
                                            <tr>
                                                <th>Código Fase</th>
                                                <th>Inicio</th>
                                                <th>Fim</th>
                                                <th>Descrição</th>
                                                <th>Código Projeto</th>
                                                <th>Código Processo</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($projeto->fases as $fase)
                                            <tr>
                                                <td>{{$fase->cod_fase}}</td>
                                                <td>{{$fase->dt_ini}}</td>
                                                <td>{{$fase->dt_fim}}</td>
                                                <td>{{$fase->descricao}}</td>
                                                <td>{{$fase->cod_projeto}}</td>
                                                <td>{{$fase->cod_proc}}</td>
                                            </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                        <h5>Cliente</h5>
                                        <table class="table table-hover">
                                            <thead>
                                            <tr>
                                                <th>Código Cliente</th>
                                                <th>Nome</th>
                                                <th>Descrição</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>{{$projeto->cpf}}</td>
                                                <td>{{$projeto->cliente->NOME}}</td>
                                                <td>{{$projeto->cliente->DESCRICAO}}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                                    </div>

                                    </div>
                                </div>
                            </div>
                            <a href="{{route('projeto', ['id' => $projeto->cod_projeto])}}" class="btn btn-success">Editar</a>
                            <a href="{{route('projeto_delete', ['id' => $projeto->cod_projeto])}}" class="btn btn-danger">Deletar</a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <br>
            <div class="row justify-content-center">
                <div>{{ $projetos->links() }}</div>  
            </div>
    </div>
    <br>
</div>


@endsection
