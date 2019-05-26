@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="row justify-content-center">
                <div class="col-md-10"><h2>Projeto/Fase</h2></div>
                <div class="col-md-2"><a  href="{{route('fase', ['id' => 'novo'])}}" class="btn btn-primary">Novo</a></div>
            </div>
            <hr>
            @if($showForm)
            <div class="card">
            <div class="card-header">Formulário de Fase</div>
            <div class="card-body">
            <form action="{{route('fase_cadastrar')}}" method="post">
                {{ csrf_field() }}
                <input type="hidden" id="cod_fase_update" name="cod_fase_update" value="{{ isset($selecionado->cod_fase) ? $selecionado->cod_fase : '' }}">
                <div class="form-group">
                    <label for="cod_fase">Código:</label>
                    <input type="text" class="form-control{{ $errors->has('cod_fase') ? ' is-invalid' : '' }}" id="cod_fase" placeholder="Entre com o cod_fase" name="cod_fase" value="{{ isset($selecionado->cod_fase) ? $selecionado->cod_fase : old('cod_fase') }}" required>
                    @if ($errors->has('cod_fase'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('cod_fase') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="dt_ini">Data Inicio:</label>
                    <input type="date" class="form-control{{ $errors->has('dt_ini') ? ' is-invalid' : '' }}" id="dt_ini" placeholder="Entre com o dt_ini" name="dt_ini"  value="{{ isset($selecionado->dt_ini) ? $selecionado->dt_ini : old('dt_ini') }}">
                    @if ($errors->has('dt_ini'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('dt_ini') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="dt_fim">Data Fim:</label>
                    <input type="date" class="form-control{{ $errors->has('dt_fim') ? ' is-invalid' : '' }}" id="dt_fim" placeholder="Entre com a descrição" name="dt_fim"  value="{{ isset($selecionado->dt_fim) ? $selecionado->dt_fim : old('dt_fim') }}">
                    @if ($errors->has('dt_fim'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('dt_fim') }}</strong>
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
                    <label for="cod_projeto">Projeto:</label>
                    <select  class="form-control" id="cod_projeto" name="cod_projeto" >
                        <option value='' selected disabled>Selecione um Projeto</option>
                            @foreach($projetos as $projeto)
                            @if($selecionado->cod_projeto == $projeto->cod_projeto)
                                <option value='{{$projeto->cod_projeto}}' selected>{{$projeto->nome}}</option>
                            @else
                                <option value='{{$projeto->cod_projeto}}'>{{$projeto->nome}}</option>
                            @endif
                            @endforeach
                    </select>
                    @if ($errors->has('cod_projeto'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('cod_projeto') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="cod_proc">Processo:</label>
                    <select  class="form-control" id="cod_proc" name="cod_proc" >
                        <option value='' selected disabled>Selecione um Processo</option>
                            @foreach($processos as $processo)
                            @if($selecionado->cod_proc == $processo->cod_proc)
                                <option value='{{$processo->cod_proc}}' selected>{{$processo->nome}}</option>
                            @else
                                <option value='{{$processo->cod_proc}}'>{{$processo->nome}}</option>
                            @endif
                            @endforeach
                    </select>
                    @if ($errors->has('cod_proc'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('cod_proc') }}</strong>
                        </span>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Salvar</button>
                <a href="{{route('fase')}}" class="btn btn-default">Fechar</a>
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
                        <th>Data Inicio</th>
                        <th>Data Fim</th>
                        <th>Descrição</th>
                        <th>Projeto</th>
                        <th>Processo</th>
                        <th>Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($fases as $fase)
                    <tr>
                        <td>{{ $fase->cod_fase }}</td>
                        <td>{{ $fase->dt_ini }}</td>
                        <td>{{ $fase->dt_fim }}</td>
                        <td>{{ $fase->descricao }}</td>
                        <td>{{ $fase->cod_projeto }}</td>
                        <td>{{ $fase->cod_proc }}</td>
                        <td>
                        <!-- Button to Open the Modal -->
                            <button type="button" class="btn btn-default" data-toggle="modal" 
                                data-target="#{{$fase->cod_fase}}">Master Detail
                            </button>
                            <!-- The Modal -->
                            <div class="modal fade" id="{{$fase->cod_fase}}">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">Master Detail - {{$fase->descricao}}</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        <h5>Projeto</h5>
                                        <table class="table table-hover">
                                            <thead>
                                            <tr>
                                                <th>Código</th>
                                                <th>Nome</th>
                                                <th>Descrição</th>
                                                <th>CPF</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>{{$fase->projeto->cod_projeto}}</td>
                                                <td>{{$fase->projeto->nome}}</td>
                                                <td>{{$fase->projeto->descricao}}</td>
                                                <td>{{$fase->projeto->cpf}}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <h5>Processo</h5>
                                        <table class="table table-hover">
                                            <thead>
                                            <tr>
                                                <th>Código</th>
                                                <th>Nome</th>
                                                <th>Descrição</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>{{$fase->cod_proc}}</td>
                                                <td>{{$fase->projeto->nome}}</td>
                                                <td>{{$fase->projeto->descricao}}</td>
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
                            <a href="{{route('fase', ['id' => $fase->cod_fase])}}" class="btn btn-success">Editar</a>
                            <a href="{{route('fase_delete', ['id' => $fase->cod_fase])}}" class="btn btn-danger">Deletar</a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <br>
            <div class="row justify-content-center">
                <div>{{ $fases->links() }}</div>  
            </div>
    </div>
    <br>
</div>
<script>
$('#dt_ini').mask('99/99/9999',{placeholder:"dd/mm/yyyy"});
$('#dt_fim').mask('99/99/9999',{placeholder:"dd/mm/yyyy"});
</script>

@endsection
