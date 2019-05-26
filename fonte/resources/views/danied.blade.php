@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Acesso Negado</div>

                <div class="card-body">
                    <h1 class="alert-danger">Você não possui permissão para acessar essa página!</h1>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
