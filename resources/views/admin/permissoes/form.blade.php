<div class="form-group {{ $errors->has('nome') ? 'has-error' : ''}}">
    <label for="nome" class="control-label">{{ 'Nome' }}</label>
    <input class="form-control" name="nome" type="text" id="nome" value="{{ isset($permissao->nome) ? $permissao->nome : ''}}" >
    {!! $errors->first('nome', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('slug') ? 'has-error' : ''}}">
    <label for="slug" class="control-label">{{ 'Slug' }}</label>
    <input class="form-control" name="slug" type="text" id="slug" value="{{ isset($permissao->slug) ? $permissao->slug : ''}}" >
    {!! $errors->first('slug', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('descricao') ? 'has-error' : ''}}">
    <label for="descricao" class="control-label">{{ 'Descrição' }}</label>
    <input class="form-control" name="descricao" type="text" id="descricao" value="{{ isset($permissao->descricao) ? $permissao->descricao : ''}}" >
    {!! $errors->first('descricao', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group">
    <label for="tela_id">Telas</label>
    <select class="form-control" name="tela_id" id="tela_id">
        <option value="">--Nenhum--</option>
        @foreach($telas as $tela)
            <option value="{{$tela->id}}" @if($formMode == 'edit' && $tela->id == $permissao->tela->id)selected="selected"@endif>
                {{$tela->nome}} -> {{$tela->descricao}}
            </option>
        @endforeach
    </select>
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
