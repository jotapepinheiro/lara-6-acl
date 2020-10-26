<div class="col-md-2">
    <div class="card">
        <div class="card-header">
            Menu
        </div>

        <div class="card-body">
            @perfil('super')
            <ul class="nav" role="tablist">
                <li role="presentation">
                    <a href="{{ url('/admin/usuarios') }}">
                        - Usuários
                    </a>
                </li>
            </ul>
            <ul class="nav" role="tablist">
                <li role="presentation">
                    <a href="{{ url('/admin/perfis') }}">
                        - Perfis
                    </a>
                </li>
            </ul>
            <ul class="nav" role="tablist">
                <li role="presentation">
                    <a href="{{ url('/admin/permissoes') }}">
                        - Permissões
                    </a>
                </li>
            </ul>
            <hr>
            <ul class="nav" role="tablist">
                <li role="presentation">
                    <a href="{{ url('/admin/clientes') }}">
                        - Clientes
                    </a>
                </li>
            </ul>
            @endPerfil
            @perfil('admin')
            <ul class="nav" role="tablist">
                <li role="presentation">
                    <a href="{{ url('/admin/usuarios') }}">
                        - Usuários
                    </a>
                </li>
            </ul>
            <ul class="nav" role="tablist">
                <li role="presentation">
                    <a href="{{ url('/admin/perfis') }}">
                        - Perfis
                    </a>
                </li>
            </ul>
            <ul class="nav" role="tablist">
                <li role="presentation">
                    <a href="{{ url('/admin/permissoes') }}">
                        - Permissões
                    </a>
                </li>
            </ul>
            @endPerfil
            @perfil('manager')
            <ul class="nav" role="tablist">
                <li role="presentation">
                    <a href="{{ url('/admin/clientes') }}">
                        - Clientes
                    </a>
                </li>
            </ul>
            @endPerfil
            @perfil('user')
            <ul class="nav" role="tablist">
                <li role="presentation">
                    <a href="{{ url('/admin/clientes') }}">
                        - Clientes
                    </a>
                </li>
            </ul>
            @endPerfil
        </div>
    </div>
</div>
