@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('includes.sidebar')

            @role(['super', 'admin'])
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Perfis</div>
                    <div class="card-body">
                        @permission('tela-create')
                        <a href="{{ url('/admin/telas/create') }}" class="btn btn-success btn-sm" title="Adicionar Tela">
                            <i class="fa fa-plus" aria-hidden="true"></i> Adicionar
                        </a>
                        @endpermission

                        @permission('tela-list')
                        <form method="GET" action="{{ url('/admin/telas') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Buscar..." value="{{ request('search') }}">
                                <span class="input-group-append">
                                    <button class="btn btn-secondary" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </form>

                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>ID</th><th>Nome</th><th>Slug</th><th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($telas as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->nome }}</td>
                                        <td>{{ $item->slug }}</td>
                                        <td>
                                            <a href="{{ url('/admin/telas/' . $item->id) }}" title=" Ver Tela"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i>  Ver</button></a>

                                            @permission('tela-edit')
                                            <a href="{{ url('/admin/telas/' . $item->id . '/edit') }}" title="Editar Tela"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button></a>
                                            @endpermission

                                            @permission('tela-delete')
                                            <form method="POST" action="{{ url('/admin/telas' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Deletar Tela" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Deletar</button>
                                            </form>
                                            @endpermission
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $telas->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>
                        @endpermission
                    </div>
                </div>
            </div>
            @endrole
        </div>
    </div>
@endsection