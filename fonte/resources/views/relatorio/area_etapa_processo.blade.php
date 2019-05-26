@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h2>Relatório</h2>
            <h5>Área/Etapa/Processo<h5>
            <hr>
            <div class="card">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th class="alert-danger">Nome Etapa</th>
                        <th class="alert-danger">Descrição Etapa</th>
                        <th>Nome Processo</th>
                        <th>Descrição Processo</th>
                        <th class="alert-success">Nome Área</th>
                        <th class="alert-success">Descrição Área</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($relatorio as $r)
                    <tr>
                        <td>{{ $r->nome }}</td>
                        <td>{{ $r->descricao }}</td>
                        <td>{{ $r->pnome }}</td>
                        <td>{{ $r->pdescricao }}</td>
                        <td>{{ $r->anome }}</td>
                        <td>{{ $r->adescricao }}</td>
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
