<div class="col-md-2">
    <div class="card">
        <div class="card-header">
            Menu
        </div>

        <div class="card-body">
            @role('super')
            <ul class="nav" role="tablist">
                <li role="presentation">
                    <a href="{{ url('/admin/perfis') }}">
                        - Perfis
                    </a>
                </li>
            </ul>
            <ul class="nav" role="tablist">
                <li role="presentation">
                    <a href="{{ url('/admin/usuarios') }}">
                        - Usuários
                    </a>
                </li>
            </ul>
            <hr>
            <ul class="nav" role="tablist">
                <li role="presentation">
                    <a href="{{ url('/admin/modulos') }}">
                        - Módulos
                    </a>
                </li>
            </ul>
            <ul class="nav" role="tablist">
                <li role="presentation">
                    <a href="{{ url('/admin/telas') }}">
                        - Telas
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
            @endrole
            @role('admin')
            <ul class="nav" role="tablist">
                <li role="presentation">
                    <a href="{{ url('/admin/perfis') }}">
                        - Perfis
                    </a>
                </li>
            </ul>
            <ul class="nav" role="tablist">
                <li role="presentation">
                    <a href="{{ url('/admin/usuarios') }}">
                        - Usuários
                    </a>
                </li>
            </ul>
            <hr>
            <ul class="nav" role="tablist">
                <li role="presentation">
                    <a href="{{ url('/admin/modulos') }}">
                        - Módulos
                    </a>
                </li>
            </ul>
            <ul class="nav" role="tablist">
                <li role="presentation">
                    <a href="{{ url('/admin/telas') }}">
                        - Telas
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
            @endrole
            @role(['admin-sga', 'admin-fornecedor'])
            <ul class="nav" role="tablist">
                <li role="presentation">
                    <a href="{{ url('/admin/clientes') }}">
                        - Clientes
                    </a>
                </li>
            </ul>
            @endrole
            @role('convidado')
            <ul class="nav" role="tablist">
                <li role="presentation">
                    <a href="{{ url('/admin/clientes') }}">
                        - Clientes
                    </a>
                </li>
            </ul>
            @endrole
        </div>
    </div>
</div>
