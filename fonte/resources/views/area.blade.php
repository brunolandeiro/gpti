@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="row justify-content-center">
                <div class="col-md-10"><h2>Area</h2></div>
                <div class="col-md-2"><a  href="{{route('area', ['id' => 'novo'])}}" class="btn btn-primary">Novo</a></div>
            </div>
            <hr>
            @if($showForm)
            <div class="card">
            <div class="card-header">Formulário de Area</div>
            <div class="card-body">
            <form action="{{route('area_cadastrar')}}" method="post">
                {{ csrf_field() }}
                <input type="hidden" id="cod_area_update" name="cod_area_update" value="{{ isset($selecionado->cod_area) ? $selecionado->cod_area : '' }}">
                <div class="form-group">
                    <label for="cod_area">Código:</label>
                    <input type="text" class="form-control{{ $errors->has('cod_area') ? ' is-invalid' : '' }}" id="cod_area" placeholder="Entre com o cod_area" name="cod_area" value="{{ isset($selecionado->cod_area) ? $selecionado->cod_area : old('cod_area') }}" required>
                    @if ($errors->has('cod_area'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('cod_area') }}</strong>
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
                <a href="{{route('area')}}" class="btn btn-default">Fechar</a>
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
                    @foreach($areas as $area)
                    <tr>
                        <td>{{ $area->cod_area }}</td>
                        <td>{{ $area->nome }}</td>
                        <td>{{ $area->descricao }}</td>
                        <td>
                        <!-- Button to Open the Modal -->
                            <button type="button" class="btn btn-default" data-toggle="modal" 
                                data-target="#{{$area->cod_area}}">Ver Etapas
                            </button>
                            <!-- The Modal -->
                            <div class="modal fade" id="{{$area->cod_area}}">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">Etapas - {{$area->nome}}</h4>
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
                                            @foreach($area->etapas as $etapa)
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
                            <a href="{{route('area', ['id' => $area->cod_area])}}" class="btn btn-success">Editar</a>
                            <a href="{{route('area_delete', ['id' => $area->cod_area])}}" class="btn btn-danger">Deletar</a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <br>
            <div class="row justify-content-center">
                <div>{{ $areas->links() }}</div>  
            </div>
    </div>
    <br>
</div>


@endsection
