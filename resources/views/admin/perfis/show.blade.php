@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('includes.sidebar')

            @role(['super', 'admin'])
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Perfil {{ $perfil->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/admin/perfis') }}" title="Voltar"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Voltar</button></a>

                        @permission('perfil-edit')
                        <a href="{{ url('/admin/perfis/' . $perfil->id . '/edit') }}" title="Editar Perfil"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button></a>
                        @endpermission

                        @permission('perfil-delete')
                        <form method="POST" action="{{ url('admin/perfis' . '/' . $perfil->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Deletar Perfil" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Deletar</button>
                        </form>
                        @endpermission

                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $perfil->id }}</td>
                                    </tr>
                                    <tr><th> Nome </th><td> {{ $perfil->nome }} </td></tr><tr><th> Slug </th><td> {{ $perfil->slug }} </td></tr>
                                </tbody>
                            </table>


                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h6 class="panel-title">Permissões do Perfil</h6>
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                                @if(count($perfil->permissoes) > 0)
                                                    @foreach($perfil->permissoes as $perm)
                                                        <tr>
                                                            <td>
                                                                <a href="{{ url('admin/permissoes', $perm->id) }}" class="label label-info">{{ $perm->nome }}</a>
                                                            </td>
                                                            <td>
                                                                {{ $perm->slug }}
                                                            </td>
                                                            <td>
                                                                {{ $perm->descricao }}
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
            @endrole
        </div>
    </div>
@endsection
