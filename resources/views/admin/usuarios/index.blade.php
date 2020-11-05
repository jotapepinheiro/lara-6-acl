@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('includes.sidebar')

            @role(['super', 'admin'])
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Usuários</div>
                    <div class="card-body">
                        @permission('usuario-create')
                        <a href="{{ url('/admin/usuarios/create') }}" class="btn btn-success btn-sm" title="Adicionar Usuário">
                            <i class="fa fa-plus" aria-hidden="true"></i> Adicionar
                        </a>
                        @endpermission

                        @permission('usuario-list')
                        <form method="GET" action="{{ url('/admin/usuarios') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
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
                                        <th>ID</th><th>Nome</th><th>E-mail</th><th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($usuarios as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->nome }}</td><td>{{ $item->email }}</td>
                                        <td>
                                            <a href="{{ url('/admin/usuarios/' . $item->id) }}" title="Ver Usuário"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i>  Ver</button></a>

                                            @permission('usuario-edit')
                                            <a href="{{ url('/admin/usuarios/' . $item->id . '/edit') }}" title="Edit User"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button></a>
                                            @endpermission

                                            @permission('usuario-delete')
                                            <form method="POST" action="{{ url('/admin/usuarios' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Deletar Usuário" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Deletar</button>
                                            </form>
                                            @endpermission
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $usuarios->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>
                        @endpermission
                    </div>
                </div>
            </div>
            @endrole
        </div>
    </div>
@endsection
