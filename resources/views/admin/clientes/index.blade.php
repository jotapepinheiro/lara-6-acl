@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('includes.sidebar')

            @perfil('super', 'manager', 'user')
            <div class="col-md-9">
                <div class="card">
                    @perfil('super', 'manager')
                    <div class="card-header">Clientes</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/clientes/create') }}" class="btn btn-success btn-sm" title="Adicionar Cliente">
                            <i class="fa fa-plus" aria-hidden="true"></i> Adicionar
                        </a>

                        <form method="GET" action="{{ url('/admin/clientes') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Buscar..." value="{{ request('search') }}">
                                <span class="input-group-append">
                                    <button class="btn btn-secondary" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </form>
                    @endPerfil
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>ID</th><th>Name</th><th>Email</th>@perfil('super', 'manager')<th>Ações</th>@endPerfil
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($clientes as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->name }}</td><td>{{ $item->email }}</td>
                                        <td>
                                @perfil('super', 'manager')
                                            <a href="{{ url('/admin/clientes/' . $item->id) }}" title=" Ver Client"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i>  Ver</button></a>
                                            <a href="{{ url('/admin/clientes/' . $item->id . '/edit') }}" title="Edit Client"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                            <form method="POST" action="{{ url('/admin/clientes' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete Client" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form>
                                @endPerfil
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $clientes->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
            @endPerfil
        </div>
    </div>
@endsection
