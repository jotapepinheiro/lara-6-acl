<div class="form-group {{ $errors->has('nome') ? 'has-error' : ''}}">
    <label for="nome" class="control-label">{{ 'Nome' }}</label>
    <input class="form-control" name="nome" type="text" id="nome" value="{{ isset($tela->nome) ? $tela->nome : ''}}" >
    {!! $errors->first('nome', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('slug') ? 'has-error' : ''}}">
    <label for="slug" class="control-label">{{ 'Slug' }}</label>
    <input class="form-control" name="slug" type="text" id="slug" value="{{ isset($tela->slug) ? $tela->slug : ''}}" >
    {!! $errors->first('slug', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('descricao') ? 'has-error' : ''}}">
    <label for="descricao" class="control-label">{{ 'Descrição' }}</label>
    <input class="form-control" name="descricao" type="text" id="descricao" value="{{ isset($tela->descricao) ? $tela->descricao : ''}}" >
    {!! $errors->first('descricao', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group">
    <label for="modulo_id">Módulo da Tela</label>
    <select class="form-control" name="modulo_id" id="modulo_id">
        <option value="">--Nenhum--</option>
        @foreach($modulos as $mod)
            <option value="{{$mod->id}}" @if($formMode == 'edit' && $mod->id == $tela->modulo_id)selected="selected"@endif>
                {{$mod->nome}} -> {{$mod->descricao}}
            </option>
        @endforeach
    </select>
</div>

@if($formMode === 'edit')
    <div class="panel panel-default">
    <div class="panel-heading">
        <h6 class="panel-title">Permissões do Tela</h6>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table">
                <tbody>
                @if(count($tela->permissoes) > 0)
                    @foreach($tela->permissoes as $perm)
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
@endif

<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
