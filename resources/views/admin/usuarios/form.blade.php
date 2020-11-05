<div class="form-group {{ $errors->has('nome') ? 'has-error' : ''}}">
    <label for="nome" class="control-label">{{ 'Nome' }}</label>
    <input class="form-control" name="nome" type="text" id="nome" value="{{ isset($usuario->nome) ? $usuario->nome : ''}}" >
    {!! $errors->first('nome', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
    <label for="email" class="control-label">{{ 'E-mail' }}</label>
    <input class="form-control" name="email" type="text" id="email" value="{{ isset($usuario->email) ? $usuario->email : ''}}" >
    {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('telefone') ? 'has-error' : ''}}">
    <label for="telefone" class="control-label">{{ 'Telefone' }}</label>
    <input class="form-control" name="telefone" type="text" id="telefone" value="{{ isset($usuario->telefone) ? $usuario->telefone : ''}}" >
    {!! $errors->first('telefone', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('celular') ? 'has-error' : ''}}">
    <label for="celular" class="control-label">{{ 'Celular' }}</label>
    <input class="form-control" name="celular" type="text" id="celular" value="{{ isset($usuario->celular) ? $usuario->celular : ''}}" >
    {!! $errors->first('celular', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}">
    <label for="password" class="control-label">{{ 'Senha' }}</label>
    <input class="form-control" name="password" type="text" id="password" value="{{ isset($usuario->password) ? $usuario->password : ''}}" >
    {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-check" {{ $errors->has('status') ? 'has-error' : ''}}>
    @if ($usuario->status === 1)
        <input type="checkbox" class="form-check-input" id="status" name="status" checked="">
    @else
        <input type="checkbox" class="form-check-input" id="status" name="status" {{ old('status') ? 'checked' : '' }} >
    @endif
    <label class="form-check-label" for="status">Status</label>
</div>

<div class="form-group">
    <label for="perfis">Perfil</label>
    <select multiple class="form-control" name="perfis[]" id="perfis">
        @foreach($perfis as $perfil)
            <option value="{{$perfil->id}}" @if($formMode == 'edit' && in_array($perfil->id, $usuario_perfis))selected="selected"@endif>
                {{$perfil->nome}} -> {{ $perfil->descricao }}
            </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="permissoes">Permissões</label>
    <select multiple class="form-control" name="permissoes[]" id="permissoes">
        @foreach($permissoes as $perm)
            <option value="{{$perm->id}}" @if($formMode == 'edit' && in_array($perm->id, $usuario_permissoes))selected="selected"@endif>
                {{$perm->nome}} -> {{ $perm->descricao }}
            </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
