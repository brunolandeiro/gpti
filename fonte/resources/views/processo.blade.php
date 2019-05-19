@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="row justify-content-center">
                <div class="col-md-10"><h2>Processo</h2></div>
                <div class="col-md-2"><a  href="{{route('processo', ['id' => 'novo'])}}" class="btn btn-primary">Novo</a></div>
            </div>
            <hr>
            @if($showForm)
            <div class="card">
            <div class="card-header">Formulário de Processo</div>
            <div class="card-body">
            <form action="{{route('processo_cadastrar')}}" method="post">
                {{ csrf_field() }}
                <input type="hidden" id="cod_proc_update" name="cod_proc_update" value="{{ isset($selecionado->cod_proc) ? $selecionado->cod_proc : '' }}">
                <div class="form-group">
                    <label for="cod_proc">Código:</label>
                    <input type="text" class="form-control{{ $errors->has('cod_proc') ? ' is-invalid' : '' }}" id="cod_proc" placeholder="Entre com o cod_proc" name="cod_proc" value="{{ isset($selecionado->cod_proc) ? $selecionado->cod_proc : old('cod_proc') }}" required>
                    @if ($errors->has('cod_proc'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('cod_proc') }}</strong>
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
                <button type="submit" class="btn btn-primary">Salvar</button>
                <a href="{{route('processo')}}" class="btn btn-default">Fechar</a>
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
                    @foreach($processos as $processo)
                    <tr>
                        <td>{{ $processo->cod_proc }}</td>
                        <td>{{ $processo->nome }}</td>
                        <td>{{ $processo->descricao }}</td>
                        <td>
                        <!-- Button to Open the Modal -->
                            <button type="button" class="btn btn-default" data-toggle="modal" 
                                data-target="#{{$processo->cod_proc}}">Ver Etapas
                            </button>
                            <!-- The Modal -->
                            <div class="modal fade" id="{{$processo->cod_proc}}">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">Etapas - {{$processo->nome}}</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        @foreach($processo->etapas as $etapa)
                                        <table class="table table-hover">
                                            <thead>
                                            <tr>
                                                <th>Código Etapa</th>
                                                <th>Código Processo</th>
                                                <th>Código Área</th>
                                                <th>Nome</th>
                                                <th>Descrição</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <td>{{$etapa->cod_etapa}}</td>
                                                <td>{{$etapa->cod_proc}}</td>
                                                <td>{{$etapa->cod_area}}</td>
                                                <td>{{$etapa->nome}}</td>
                                                <td>{{$etapa->descricao}}</td>
                                            </tbody>
                                        </table>
                                        @endforeach
                                    </div>

                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                                    </div>

                                    </div>
                                </div>
                            </div>
                            <a href="{{route('processo', ['id' => $processo->cod_proc])}}" class="btn btn-success">Editar</a>
                            <a href="{{route('delete', ['id' => $processo->cod_proc])}}" class="btn btn-danger">Deletar</a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <br>
            <div class="row justify-content-center">
                <div>{{ $processos->links() }}</div>  
            </div>
    </div>
    <br>
</div>


@endsection
