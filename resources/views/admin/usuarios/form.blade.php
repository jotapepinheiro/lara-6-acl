<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="control-label">{{ 'Name' }}</label>
    <input class="form-control" name="name" type="text" id="name" value="{{ isset($usuario->name) ? $usuario->name : ''}}" >
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
    <label for="email" class="control-label">{{ 'Email' }}</label>
    <input class="form-control" name="email" type="text" id="email" value="{{ isset($usuario->email) ? $usuario->email : ''}}" >
    {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}">
    <label for="password" class="control-label">{{ 'Password' }}</label>
    <input class="form-control" name="password" type="text" id="password" value="{{ isset($usuario->password) ? $usuario->password : ''}}" >
    {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <label for="perfis">Perfil</label>
    <select multiple class="form-control" name="perfis[]" id="perfis">
        @foreach($perfis as $perfil)
            <option value="{{$perfil->id}}" @if($formMode == 'edit' && in_array($perfil->id, $usuario_perfis))selected="selected"@endif>
                {{$perfil->nome}}
            </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="permissoes">Permissões</label>
    <select multiple class="form-control" name="permissoes[]" id="permissoes">
        @foreach($permissoes as $perm)
            <option value="{{$perm->id}}" @if($formMode == 'edit' && in_array($perm->id, $usuario_permissoes))selected="selected"@endif>
                {{$perm->nome}}
            </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
