<div class="form-group {{ $errors->has('nome') ? 'has-error' : ''}}">
    <label for="nome" class="control-label">{{ 'Nome' }}</label>
    <input class="form-control" name="nome" type="text" id="nome" value="{{ isset($modulo->nome) ? $modulo->nome : ''}}" >
    {!! $errors->first('nome', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('slug') ? 'has-error' : ''}}">
    <label for="slug" class="control-label">{{ 'Slug' }}</label>
    <input class="form-control" name="slug" type="text" id="slug" value="{{ isset($modulo->slug) ? $modulo->slug : ''}}" >
    {!! $errors->first('slug', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('descricao') ? 'has-error' : ''}}">
    <label for="descricao" class="control-label">{{ 'Descrição' }}</label>
    <input class="form-control" name="descricao" type="text" id="descricao" value="{{ isset($modulo->descricao) ? $modulo->descricao : ''}}" >
    {!! $errors->first('descricao', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group">
    <label for="telas">Telas</label>
    <select multiple class="form-control" name="telas[]" id="telas">
        @foreach($telas as $tela)
            <option value="{{$tela->id}}" @if($formMode == 'edit' && in_array($tela->id, $modulo_telas))selected="selected"@endif>
                {{$tela->nome}}
            </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="permissoes">Permissões</label>
    <select multiple class="form-control" name="permissoes[]" id="permissoes">
        @foreach($permissoes as $perm)
            <option value="{{$perm->id}}">
                {{$perm->nome}}
            </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>