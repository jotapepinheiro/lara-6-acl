@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('includes.sidebar')

            @role(['super', 'admin'])
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Usuário {{ $usuario->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/admin/usuarios') }}" title="Voltar"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Voltar</button></a>

                        @permission('usuario-edit')
                        <a href="{{ url('/admin/usuarios/' . $usuario->id . '/edit') }}" title="Editar Usuário"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button></a>
                        @endpermission

                        @permission('usuario-delete')
                        <form method="POST" action="{{ url('admin/usuarios' . '/' . $usuario->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Deletar Usuário" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Deletar</button>
                        </form>
                        @endpermission
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th>
                                        <td>{{ $usuario->id }}</td>
                                    </tr>
                                    <tr>
                                        <th>Name</th>
                                        <td>{{ $usuario->nome }}</td>
                                    </tr>
                                    <tr>
                                        <th>E-mail</th>
                                        <td>{{ $usuario->email }}</td>
                                    </tr>
                                    <tr>
                                        <th>Telefone</th>
                                        <td>{{ $usuario->telefone }}</td>
                                    </tr>
                                    <tr>
                                        <th>Celular</th>
                                        <td>{{ $usuario->celular }}</td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td>{{ $usuario->status }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <hr />

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h6 class="panel-title">Perfis</h6>
                                    </div>
                                    <div class="panel-body">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <tbody>
                                                @if(count($usuario->perfis) > 0)
                                                    @foreach ($usuario->perfis as $perfil)
                                                        <tr>
                                                            <td>
                                                                <a href="{{ url('admin/perfis', $perfil->id) }}" class="label label-info">{{ $perfil->nome }}</a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td class="text-danger text-center">
                                                            <p><strong>Nenhum perfil vinculado</strong></p>
                                                        </td>
                                                    </tr>
                                                @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h6 class="panel-title">Permissões do Perfil</h6>
                                    </div>
                                    <div class="panel-body">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <tbody>
                                                @if(count($usuario->perfis) > 0)
                                                    @foreach ($usuario->perfis as $perfil)
                                                        @if(count($perfil->permissoes) > 0)
                                                            @foreach($perfil->permissoes as $perm)
                                                                <tr>
                                                                    <td>
                                                                        <a href="{{ url('admin/permissoes', $perm->id) }}" class="label label-info">{{ $perm->nome }}</a>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                            @else
                                                                <tr>
                                                                    <td class="text-danger text-center">
                                                                        <p><strong>Nenhuma permissão vinculada</strong></p>
                                                                    </td>
                                                                </tr>
                                                        @endif
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td class="text-danger text-center">
                                                            <p><strong>Nenhum perfil vinculado</strong></p>
                                                        </td>
                                                    </tr>
                                                @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h6 class="panel-title">Permissões do Usuário</h6>
                                    </div>
                                    <div class="panel-body">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <tbody>
                                                @if(count($usuario->permissoes) > 0)
                                                    @foreach ($usuario->permissoes as $perm)
                                                        <tr>
                                                            <td>
                                                                <a href="{{ url('admin/permissoes', $perm->id) }}" class="label label-info">{{ $perm->nome }}</a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td class="text-danger text-center">
                                                            <p><strong>Nenhuma permissão vinculada</strong></p>
                                                        </td>
                                                    </tr>
                                                @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            @endrole
        </div>
    </div>
@endsection
