@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="row justify-content-center">
                <div class="col-md-10"><h2>EFS/Etapa</h2></div>
                <div class="col-md-2"><a  href="{{route('efs_etapa', ['cod_efs' => 'novo'])}}" class="btn btn-primary">Novo</a></div>
            </div>
            <hr>
            @if($showForm)
                <div class="card">
                <div class="card-header">Formulário de Efs/Etapa</div>
                <div class="card-body">
                    <form action="{{route('efs_etapa_cadastrar')}}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" id="cod_efs_update" name="cod_efs_update" value="{{ isset($selecionado->cod_efs) ? $selecionado->cod_efs : '' }}">       
                        <input type="hidden" id="cod_etapa_update" name="cod_etapa_update" value="{{ isset($selecionado->cod_etapa) ? $selecionado->cod_etapa : '' }}">
                        <div class="form-group">
                            <label for="efs">Efs:</label>
                            <select  class="form-control" id="cod_efs" name="cod_efs" >
                                <option value='' selected disabled>Selecione um efs</option>
                                @foreach($efss as $efs)
                                    @if($selecionado->cod_efs == $efs->cod_efs)
                                    <option value='{{$efs->cod_efs}}' selected>{{$efs->nome}}</option>
                                    @else
                                    <option value='{{$efs->cod_efs}}'>{{$efs->nome}}</option>
                                    @endif
                                @endforeach
                            </select>
                            @if ($errors->has('efs'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('efs') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="etapa">Etapa:</label>
                            <select  class="form-control" id="cod_etapa" name="cod_etapa" >
                                <option value='' selected disabled>Selecione um área</option>
                                @foreach($etapas as $etapa)
                                    @if($selecionado->cod_etapa == $etapa->cod_etapa)
                                    <option value='{{$etapa->cod_etapa}}' selected>{{$etapa->nome}}</option>
                                    @else
                                    <option value='{{$etapa->cod_etapa}}'>{{$etapa->nome}}</option>
                                    @endif
                                @endforeach
                            </select>
                            @if ($errors->has('etapa'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('etapa') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="tipo">Tipo:</label>
                            <input type="text" class="form-control{{ $errors->has('tipo') ? ' is-invalid' : '' }}" id="tipo" placeholder="Entre com o tipo" name="tipo" value="{{ isset($selecionado->tipo) ? $selecionado->tipo : old('tipo') }}" required>
                            @if ($errors->has('tipo'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('tipo') }}</strong>
                                </span>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                        <a href="{{route('efs_etapa')}}" class="btn btn-default">Fechar</a>
                    </form>
                </div>
                </div>
                <br>
            @endif
            <div class="card">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Código EFS</th>
                        <th>Código Etapa</th>
                        <th>Tipo</th>
                        <th>Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($efs_etapas as $efs_etapa)
                    <tr>
                        <td>{{ $efs_etapa->cod_efs }}</td>
                        <td>{{ $efs_etapa->cod_etapa }}</td>
                        <td>{{ $efs_etapa->tipo }}</td>
                        <td>
                        <!-- Button to Open the Modal -->
                        <button type="button" class="btn btn-default" data-toggle="modal" 
                            data-target="#{{$efs_etapa->cod_efs}}{{$efs_etapa->cod_etapa}}">Master Detail
                        </button>
                        <!-- The Modal -->
                        <div class="modal fade" id="{{$efs_etapa->cod_efs}}{{$efs_etapa->cod_etapa}}">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">Master Detail</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        <h5>Etapas</h5>
                                        <table class="table table-hover">
                                            <thead>
                                            <tr>
                                                <th>Código Etapa</th>
                                                <th>Nome</th>
                                                <th>Descrição</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($efs_etapa->etapas as $etapa)
                                            <tr>
                                                <td>{{$etapa->cod_etapa}}</td>
                                                <td>{{$etapa->nome}}</td>
                                                <td>{{$etapa->descricao}}</td>
                                            </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                        <h5>EFS</h5>
                                        <table class="table table-hover">
                                            <thead>
                                            <tr>
                                                <th>Código EFS</th>
                                                <th>Nome</th>
                                                <th>Descrição</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($efs_etapa->efss as $efs)
                                            <tr>
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
                            <a href="{{route('efs_etapa', ['cod_efs' => $efs_etapa->cod_efs, 'cod_etapa' => $efs_etapa->cod_etapa] ) }}" class="btn btn-success">Editar</a>
                            <a href="{{route('efs_etapa_delete', ['cod_efs' => $efs_etapa->cod_efs, 'cod_etapa' => $efs_etapa->cod_etapa] ) }}" class="btn btn-danger">Excluir</a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <br>
            <div class="row justify-content-center">
            </div>
    </div>
    <br>
</div>


@endsection
