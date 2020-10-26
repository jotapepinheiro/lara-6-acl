<?php

use Illuminate\Database\Seeder;
use App\Permissao;
use App\Perfil;
use App\Usuario;

class PermissionsSeeder extends Seeder
{
    public function run()
    {
        // Consultar e guardar em $super_permissao a permissão all-all e demais
        $super_permissao = Permissao::where('slug','all-all')->first();
        $admin_permissao1 = Permissao::where('slug','users-all')->first();
        $admin_permissao2 = Permissao::where('slug','perfis-all')->first();
        $admin_permissao3 = Permissao::where('slug','permissoes-all')->first();
        $manager_permissao1 = Permissao::where('slug', 'clientes-all')->first();
        $user_permissao = Permissao::where('slug', 'clientes-index')->first();

        // Cadastrar a perfil super e anexar a ela suas permissões
        $super_perfil = new Perfil();
        $super_perfil->slug = 'super';
        $super_perfil->nome = 'Super perfil';
        $super_perfil->save();
        $super_perfil->permissoes()->attach($super_permissao); // para que esta permissao seja anexada sem problema, precisa existir em 'permissoes'

        // Cadastrar a perfil admin e anexar a ela suas permissões
        $admin_perfil = new Perfil();
        $admin_perfil->slug = 'admin';
        $admin_perfil->nome = 'Admin perfil';
        $admin_perfil->save();
        $admin_perfil->permissoes()->attach($admin_permissao1);
        $admin_perfil->permissoes()->attach($admin_permissao2);
        $admin_perfil->permissoes()->attach($admin_permissao3);

        // Cadastrar a perfil manager e anexar a ela suas permissões
        $manager_perfil = new Perfil();
        $manager_perfil->slug = 'manager';
        $manager_perfil->nome = 'Manager perfil';
        $manager_perfil->save();
        $manager_perfil->permissoes()->attach($manager_permissao1);

        // Cadastrar a perfil user e anexar a ela suas permissões
        $user_perfil = new Perfil();
        $user_perfil->slug = 'user';
        $user_perfil->nome = 'Uer perfil';
        $user_perfil->save();
        $user_perfil->permissoes()->attach($user_permissao);

        // Consultar e guardar em $super_perfil a perfil super e demais
        $super_perfil = Perfil::where('slug','super')->first();
        $admin_perfil = Perfil::where('slug','admin')->first();
        $manager_perfil = Perfil::where('slug', 'manager')->first();
        $user_perfil = Perfil::where('slug','user')->first();

        // Cadastrar no banco a permissao all-all e anexar sua(a) respectiva(s) perfil(s)
        $all_all = new Permissao();
        $all_all->slug = 'all-all';
        $all_all->nome = 'Todas para Super Admin';
        $all_all->save();
        $all_all->perfis()->attach($super_perfil); // para que esta perfil seja anexada sem problema, precisa existir em 'perfis'

        // Cadastrar no banco a permissao user-all e anexar sua(a) respectiva(s) perfil(s)
        $users_all = new Permissao();
        $users_all->slug = 'users-all';
        $users_all->nome = 'Todos os Usuários';
        $users_all->save();
        $users_all->perfis()->attach($admin_perfil);

        // Cadastrar no banco a permissao perfis-all e anexar sua(a) respectiva(s) perfil(s)
        $perfis_all = new Permissao();
        $perfis_all->slug = 'perfis-all';
        $perfis_all->nome = 'Todos os Perfis';
        $perfis_all->save();
        $perfis_all->perfis()->attach($admin_perfil);

        // Cadastrar no banco a permissao permissoes-all e anexar sua(a) respectiva(s) perfil(s)
        $permissoes_all = new Permissao();
        $permissoes_all->slug = 'permissoes-all';
        $permissoes_all->nome = 'Todas as Permissões';
        $permissoes_all->save();
        $permissoes_all->perfis()->attach($admin_perfil);

        // Cadastrar no banco a permissao clientes-all e anexar sua(a) respectiva(s) perfil(s)
        $clientes_all = new Permissao();
        $clientes_all->slug = 'clientes-all';
        $clientes_all->nome = 'Todos os Clientes all';
        $clientes_all->save();
        $clientes_all->perfis()->attach($manager_perfil);

        // Cadastrar no banco a permissao clientes-index e anexar sua(a) respectiva(s) perfil(s)
        $clientes_index = new Permissao();
        $clientes_index->slug = 'clientes-index';
        $clientes_index->nome = 'Clients index';
        $clientes_index->save();
        $clientes_index->perfis()->attach($user_perfil);

        // Consultar e guardar em $super_perfil a perfil super
        $super_perfil = Perfil::where('slug','super')->first();
        $admin_perfil = Perfil::where('slug','admin')->first();
        $manager_perfil = Perfil::where('slug', 'manager')->first();
        $user_perfil = Perfil::where('slug', 'user')->first();

        // Consultar e guardar em $super_perm a permissão all-all e demais
        $super_perm = Permissao::where('slug','all-all')->first();
        $admin_perm1 = Permissao::where('slug','usuarios-all')->first();
        $admin_perm2 = Permissao::where('slug','perfis-all')->first();
        $admin_perm3 = Permissao::where('slug','permissoes-all')->first();
        $manager_perm1 = Permissao::where('slug','clientes-all')->first();
        $manager_perm2 = Permissao::where('slug','products-all')->first();
        $user_perm = Permissao::where('slug','clientes-index')->first();

        // Cadastrar o user Super no banco e anexar a ele sua(s) respectiva(s) perfil(s) e permissao(s)
        $super = new Usuario();
        $super->name = 'Super user';
        $super->email = 'super@mail.org';
        $super->password = bcrypt('123456');
        $super->save();
        $super->perfis()->attach($super_perfil); // Esta perfil precisa existir em 'perfis' para que seja adequadamente anexada
        $super->permissoes()->attach($super_perm); // Esta perfil precisa existir em 'permissoes' para que seja adequadamente anexada

        // Cadastrar o user Admin no banco e anexar a ele sua(s) respectiva(s) perfil(s) e permissao(s)
        $admin = new Usuario();
        $admin->name = 'Admin user';
        $admin->email = 'admin@mail.org';
        $admin->password = bcrypt('123456');
        $admin->save();
        $admin->perfis()->attach($admin_perfil);
        $admin->permissoes()->attach($admin_perm1);
        $admin->permissoes()->attach($admin_perm2);
        $admin->permissoes()->attach($admin_perm3);

        // Cadastrar o user Manager no banco e anexar a ele sua(s) respectiva(s) perfil(s) e permissao(s)
        $manager = new Usuario();
        $manager->name = 'Manager user';
        $manager->email = 'manager@mail.org';
        $manager->password = bcrypt('123456');
        $manager->save();
        $manager->perfis()->attach($manager_perfil);
        $manager->permissoes()->attach($manager_perm1);
        $manager->permissoes()->attach($manager_perm2);

        // Cadastrar o user User no banco e anexar a ele sua(s) respectiva(s) perfil(s) e permissao(s)
        $user = new Usuario();
        $user->name = 'User user';
        $user->email = 'user@mail.org';
        $user->password = bcrypt('123456');
        $user->save();
        $user->perfis()->attach($user_perfil);
        $user->permissoes()->attach($user_perm);

        //return redirect()->back();
    }
}
