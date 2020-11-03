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

<div class="form-group">
    <label for="permissoes">Permissões</label>
    <select multiple class="form-control" name="permissoes[]" id="permissoes">
        <option value="">--Nenhum--</option>
        @foreach($permissoes as $perm)
            <option value="{{$perm->id}}" @if($formMode == 'edit' && in_array($perm->id, $tela_permissoes))selected="selected"@endif>
                {{$perm->nome}} -> {{$perm->descricao}}
            </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
