<?php

use App\Model\Acl\Usuario;
use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Seeder;

class UsuariosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws BindingResolutionException
     */
    public function run()
    {
        Usuario::create([
            'nome'              => 'Super',
            'email'             => 'super@super.com',
            'telefone'          => '65999999999',
            'status'            => 1,
            'password'          => app('hash')->make('super'),
            'email_verified_at' => Carbon::now()->add(1, 'hour'),
            'created_at'        => Carbon::now()
        ])->perfis()->sync([1]);

        $admin = Usuario::create([
            'nome'        => 'Admin',
            'email'       => 'admin@admin.com',
            'telefone'    => '65999999999',
            'status'      => 1,
            'password'    => app('hash')->make('admin'),
            'email_verified_at' => Carbon::now()->add(2, 'hour'),
            'created_at'  => Carbon::now()
        ]);
        $admin->perfis()->sync([2,3,4]);
        $admin->permissoes()->sync([4,12]);

        $adminSga = Usuario::create([
            'nome'        => 'Admin SGA',
            'email'       => 'admin-sga@admin.com',
            'telefone'    => '65999999999',
            'status'      => 1,
            'password'    => app('hash')->make('admin-sga'),
            'email_verified_at' => Carbon::now()->add(2, 'hour'),
            'created_at'  => Carbon::now()
        ]);
        $adminSga->perfis()->sync([3]);
        $adminSga->permissoes()->sync([4,12]);

        $adminForn = Usuario::create([
            'nome'        => 'Admin Fornecedor',
            'email'       => 'admin-fornecedor@admin.com',
            'telefone'    => '65999999999',
            'status'      => 1,
            'password'    => app('hash')->make('admin-fornecedor'),
            'email_verified_at' => Carbon::now()->add(2, 'hour'),
            'created_at'  => Carbon::now()
        ]);
        $adminForn->perfis()->sync([4]);
        $adminForn->permissoes()->sync([4,12]);

        $princpal = Usuario::create([
            'nome'        => 'Principal',
            'email'       => 'principal@principal.com',
            'telefone'    => '65999999999',
            'status'      => 1,
            'password'    => app('hash')->make('principal'),
            'email_verified_at' => Carbon::now()->add(2, 'hour'),
            'created_at'  => Carbon::now()
        ]);
        $princpal->perfis()->sync([5]);
        $princpal->permissoes()->sync([15]);

        $sga = Usuario::create([
            'nome'        => 'SGA',
            'email'       => 'sga@sga.com',
            'telefone'    => '65999999999',
            'status'      => 1,
            'password'    => app('hash')->make('sga'),
            'email_verified_at' => Carbon::now()->add(2, 'hour'),
            'created_at'  => Carbon::now()
        ]);
        $sga->perfis()->sync([6]);
        $sga->permissoes()->sync([15]);

        $fornecedor = Usuario::create([
            'nome'        => 'Fornecedor',
            'email'       => 'fornecedor@fornecedor.com',
            'telefone'    => '65999999999',
            'status'      => 1,
            'password'    => app('hash')->make('fornecedor'),
            'email_verified_at' => Carbon::now()->add(2, 'hour'),
            'created_at'  => Carbon::now()
        ]);
        $fornecedor->perfis()->sync([7]);
        $fornecedor->permissoes()->sync([15]);

        // CADATRAR 50 USUARIOS CONVIDADOS
        $faker = Faker::create();

        for ($i = 1; $i <= 50; $i ++)
        {
            $date = Carbon::now()->subDays(rand(1, 28))->subMonth(rand(1, 12));

            Usuario::create([
                'nome'     => $faker->name,
                'email'    => $faker->unique()->safeEmail,
                'telefone' => '65999999999',
                'status'   => 1,
                'password' => app('hash')->make('convidado'),
                'email_verified_at' => Carbon::parse($date)->addHour(rand(1, 12)),
                'created_at'  => $date,
                'updated_at'  => Carbon::parse($date)->addDay(rand(1, 28))->addHour(rand(1, 12))
            ])->perfis()->sync([8]);
        }
    }
}
