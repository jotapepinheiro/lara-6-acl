@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('includes.sidebar')

            @role(['super', 'admin'])
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Módulo {{ $modulo->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/admin/modulos') }}" title="Voltar"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Voltar</button></a>

                        @permission('modulo-edit')
                        <a href="{{ url('/admin/modulos/' . $modulo->id . '/edit') }}" title="Editar Módulo"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button></a>
                        @endpermission

                        @permission('modulo-delete')
                        <form method="POST" action="{{ url('admin/modulos' . '/' . $modulo->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Deletar Módulo" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Deletar</button>
                        </form>
                        @endpermission
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th>
                                        <td>{{ $modulo->id }}</td>
                                    </tr>
                                    <tr>
                                        <th> Nome </th>
                                        <td> {{ $modulo->nome }} </td>
                                    </tr>
                                    <tr>
                                        <th> Slug </th>
                                        <td> {{ $modulo->slug }} </td>
                                    </tr>
                                    <tr>
                                        <th> Descrição </th>
                                        <td> {{ $modulo->descricao }} </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <hr />

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h6 class="panel-title">Telas Vinculadas</h6>
                                    </div>
                                    <div class="panel-body">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <tbody>
                                                @if(count($modulo->telas) > 0)
                                                    @foreach($modulo->telas as $tela)
                                                        <tr>
                                                            <td>
                                                                Tela: <a href="{{ url('admin/telas', $tela->id) }}" class="label label-info">{{ $tela->nome }}</a>
                                                                @if(count($tela->permissoes) > 0)
                                                                @foreach($tela->permissoes as $perm)
                                                                    <tr>
                                                                        <td>
                                                                            Permissão: <a href="{{ url('admin/permissoes', $perm->id) }}" class="label label-info">{{ $perm->nome }}</a>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            @else
                                                                <tr>
                                                                    <td class="text-danger text-center">
                                                                        <p><strong>{{$tela->nome}} - Nenhuma permissão vinculada</strong></p>
                                                                    </td>
                                                                </tr>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td class="text-danger text-center">
                                                            <p><strong>Nenhuma tela vinculada</strong></p>
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
