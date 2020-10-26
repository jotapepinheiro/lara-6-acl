@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('includes.sidebar')

            @perfil('super', 'manager')
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Editar Cliente #{{ $cliente->id }}</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/clientes') }}" title="Voltar"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Voltar</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form method="POST" action="{{ url('/admin/clientes/' . $cliente->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}

                            @include ('admin.clientes.form', ['formMode' => 'edit'])

                        </form>

                    </div>
                </div>
            </div>
            @endPerfil
        </div>
    </div>
@endsection
