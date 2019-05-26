@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h2>Relatório</h2>
            <h5>Efs/Etapa<h5>
            <hr>
            <div class="card">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th class="alert-danger">Nome Etapa</th>
                        <th class="alert-danger">Descrição Etapa</th>
                        <th>Tipo</th>
                        <th>Código Processo</th>
                        <th class="alert-success">Nome EFS</th>
                        <th class="alert-success">Descrição EFS</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($relatorio as $r)
                    <tr>
                        <td>{{ $r->enome }}</td>
                        <td>{{ $r->edescricao }}</td>
                        <td>{{ $r->tipo }}</td>
                        <td>{{ $r->cod_proc }}</td>
                        <td>{{ $r->efsnome }}</td>
                        <td>{{ $r->efsdescricao }}</td>
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
