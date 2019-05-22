@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="row justify-content-center">
                <div class="col-md-10"><h2>Área/Etapa</h2></div>
                <div class="col-md-2"><a  href="{{route('etapa', ['id' => 'novo'])}}" class="btn btn-primary">Novo</a></div>
            </div>
            <hr>
            @if($showForm)
            <div class="card">
            <div class="card-header">Formulário de Etapa</div>
            <div class="card-body">
            <form action="{{route('etapa_cadastrar')}}" method="post">
                {{ csrf_field() }}
                <input type="hidden" id="cod_etapa_update" name="cod_etapa_update" value="{{ isset($selecionado->cod_etapa) ? $selecionado->cod_etapa : '' }}">
                <div class="form-group">
                    <label for="cod_etapa">Código:</label>
                    <input type="text" class="form-control{{ $errors->has('cod_etapa') ? ' is-invalid' : '' }}" id="cod_etapa" placeholder="Entre com o cod_etapa" name="cod_etapa" value="{{ isset($selecionado->cod_etapa) ? $selecionado->cod_etapa : old('cod_etapa') }}" required>
                    @if ($errors->has('cod_etapa'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('cod_etapa') }}</strong>
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
                    <label for="processo">Processo:</label>
                    <select  class="form-control" id="processo" name="processo" >
                        <option value='' selected disabled>Selecione um processo</option>
                        @foreach($processos as $processo)
                            @if($selecionado->cod_proc == $processo->cod_proc)
                            <option value='{{$processo->cod_proc}}' selected>{{$processo->nome}}</option>
                            @else
                            <option value='{{$processo->cod_proc}}'>{{$processo->nome}}</option>
                            @endif
                        @endforeach
                    </select>
                    @if ($errors->has('processo'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('processo') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="area">Área:</label>
                    <select  class="form-control" id="area" name="area" >
                        <option value='' selected disabled>Selecione um área</option>
                        @foreach($areas as $area)
                            @if($selecionado->cod_area == $area->cod_area)
                            <option value='{{$area->cod_area}}' selected>{{$area->nome}}</option>
                            @else
                            <option value='{{$area->cod_area}}'>{{$area->nome}}</option>
                            @endif
                        @endforeach
                    </select>
                    @if ($errors->has('area'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('area') }}</strong>
                        </span>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Salvar</button>
                <a href="{{route('etapa')}}" class="btn btn-default">Fechar</a>
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
                        <th>Porcesso</th>
                        <th>Área</th>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($etapas as $etapa)
                    <tr>
                        <td>{{ $etapa->cod_etapa }}</td>
                        @if($etapa->processo)
                            <td>{{ $etapa->processo->nome }}</td>
                        @else
                            <td></td>
                        @endif
                        @if($etapa->area)
                            <td>{{ $etapa->area->nome }}</td>
                        @else
                            <td></td>
                        @endif
                        <td>{{ $etapa->nome }}</td>
                        <td>{{ $etapa->descricao }}</td>
                        <td>
                        <!-- Button to Open the Modal -->
                            <button type="button" class="btn btn-default" data-toggle="modal" 
                                data-target="#{{$etapa->cod_etapa}}">Master Detail
                            </button>
                            <!-- The Modal -->
                            <div class="modal fade" id="{{$etapa->cod_etapa}}">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">Master Detail - {{$etapa->nome}}</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        <h5>Área & Processo</h5>
                                        <table class="table table-hover">
                                            <thead>
                                            <tr>
                                                <th>Tipo</th>
                                                <th>Código Etapa</th>
                                                <th>Código</th>
                                                <th>Nome</th>
                                                <th>Descrição</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @if($etapa->processo)
                                                <tr>
                                                    <td>Processo</td>
                                                    <td>{{$etapa->cod_etapa}}</td>
                                                    <td>{{$etapa->processo->cod_proc}}</td>
                                                    <td>{{$etapa->processo->nome}}</td>
                                                    <td>{{$etapa->processo->descricao}}</td>
                                                </tr>
                                                @endif
                                                @if($etapa->area)
                                                <tr>
                                                    <td>Área</td>
                                                    <td>{{$etapa->cod_etapa}}</td>
                                                    <td>{{$etapa->area->cod_area}}</td>
                                                    <td>{{$etapa->area->nome}}</td>
                                                    <td>{{$etapa->area->descricao}}</td>
                                                </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                        <h5>Efs</h5>
                                        <table class="table table-hover">
                                            <thead>
                                            <tr>
                                                <th>Código Etapa</th>
                                                <th>Código Efs</th>
                                                <th>Nome</th>
                                                <th>Descrição</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($etapa->efss as $efs)
                                                <tr>
                                                    <td>{{$etapa->cod_etapa}}</td>
                                                    <td>{{$efs->cod_efs}}</td>
                                                    <td>{{$efs->nome}}</td>
                                                    <td>{{$efs->descricao}}</td>
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
                            <a href="{{route('etapa', ['id' => $etapa->cod_etapa])}}" class="btn btn-success">Editar</a>
                            <a href="{{route('delete', ['id' => $etapa->cod_etapa])}}" class="btn btn-danger">Deletar</a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <br>
            <div class="row justify-content-center">
                <div>{{ $etapas->links() }}</div>  
            </div>
    </div>
    <br>
</div>


@endsection
