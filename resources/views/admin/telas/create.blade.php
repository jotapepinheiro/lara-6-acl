@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('includes.sidebar')

            @role(['super', 'admin'])
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Adicionar Tela</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/telas') }}" title="Voltar"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Voltar</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form method="POST" action="{{ url('/admin/telas') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            @include ('admin.telas.form', ['formMode' => 'create'])

                        </form>

                    </div>
                </div>
            </div>
            @endrole
        </div>
    </div>
@endsection
