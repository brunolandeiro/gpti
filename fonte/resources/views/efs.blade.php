@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="row justify-content-center">
                <div class="col-md-10"><h2>Efs</h2></div>
                <div class="col-md-2"><a  href="{{route('efs', ['id' => 'novo'])}}" class="btn btn-primary">Novo</a></div>
            </div>
            <hr>
            @if($showForm)
            <div class="card">
            <div class="card-header">Formulário de Efs</div>
            <div class="card-body">
            <form action="{{route('efs_cadastrar')}}" method="post">
                {{ csrf_field() }}
                <input type="hidden" id="cod_efs_update" name="cod_efs_update" value="{{ isset($selecionado->cod_efs) ? $selecionado->cod_efs : '' }}">
                <div class="form-group">
                    <label for="cod_efs">Código:</label>
                    <input type="text" class="form-control{{ $errors->has('cod_efs') ? ' is-invalid' : '' }}" id="cod_efs" placeholder="Entre com o cod_efs" name="cod_efs" value="{{ isset($selecionado->cod_efs) ? $selecionado->cod_efs : old('cod_efs') }}" required>
                    @if ($errors->has('cod_efs'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('cod_efs') }}</strong>
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
                    <label for="etapas">Etapa:</label>
                    <select class="form-control" multiple="multiple" name="etapas[]" id="etapas">
                        @foreach($etapas as $etapa)
                            <option value="{{$etapa->cod_etapa}}" >{{$etapa->nome}}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('etapas'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('etapas') }}</strong>
                        </span>
                    @endif
                </div>
                <div id="etapas">
                <div>
                <button type="submit" class="btn btn-primary">Salvar</button>
                <a href="{{route('efs')}}" class="btn btn-default">Fechar</a>
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
                    @foreach($efss as $efs)
                    <tr>
                        <td>{{ $efs->cod_efs }}</td>
                        <td>{{ $efs->nome }}</td>
                        <td>{{ $efs->descricao }}</td>
                        <td>
                        <!-- Button to Open the Modal -->
                            <button type="button" class="btn btn-default" data-toggle="modal" 
                                data-target="#{{$efs->cod_efs}}">Ver Etapas
                            </button>
                            <!-- The Modal -->
                            <div class="modal fade" id="{{$efs->cod_efs}}">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">Etapas - {{$efs->nome}}</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <!-- Modal body -->
                                    <div class="modal-body">
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
                                            @foreach($efs->etapas as $etapa)
                                            <tr>
                                                <td>{{$etapa->cod_etapa}}</td>
                                                <td>{{$etapa->cod_proc}}</td>
                                                <td>{{$etapa->cod_area}}</td>
                                                <td>{{$etapa->nome}}</td>
                                                <td>{{$etapa->descricao}}</td>
                                            </tr>
                                            @endforeach
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
                            <a href="{{route('efs', ['id' => $efs->cod_efs])}}" class="btn btn-success">Editar</a>
                            <a href="{{route('delete', ['id' => $efs->cod_efs])}}" class="btn btn-danger">Deletar</a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <br>
            <div class="row justify-content-center">
                <div>{{ $efss->links() }}</div>  
            </div>
    </div>
    <br>
</div>


<script>
$('#etapa').onchange(function(){
    console.log($('#etapa'));
})
<script>
@endsection
