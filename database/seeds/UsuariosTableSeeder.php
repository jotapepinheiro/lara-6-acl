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
        // CADATRAR SUPER ADMIN
        Usuario::create([
            'name'              => 'Super',
            'email'             => 'super@super.com',
            'password'          => app('hash')->make('super'),
            'email_verified_at' => Carbon::now()->add(1, 'hour'),
            'created_at'        => Carbon::now()
        ])->perfis()->sync([1]);

        // CADATRAR ADMIN
        $admin = Usuario::create([
            'name'        => 'Admin',
            'email'       => 'admin@admin.com',
            'password'    => app('hash')->make('admin'),
            'email_verified_at' => Carbon::now()->add(2, 'hour'),
            'created_at'  => Carbon::now()
        ]);
        $admin->perfis()->sync([2]);
        $admin->permissoes()->sync([6,10]);

        // CADATRAR TECNICO
        $tecnico = Usuario::create([
            'name'        => 'Tecnico',
            'email'       => 'tecnico@tecnico.com',
            'password'    => app('hash')->make('tecnico'),
            'email_verified_at' => Carbon::now()->add(2, 'hour'),
            'created_at'  => Carbon::now()
        ]);
        $tecnico->perfis()->sync([3]);
        $tecnico->permissoes()->sync([5,9]);

        // CADATRAR 50 USUARIOS TECNICOS
        $faker = Faker::create();

        for ($i = 1; $i <= 50; $i ++)
        {
            $date = Carbon::now()->subDays(rand(1, 28))->subMonth(rand(1, 12));

            Usuario::create([
                'name'     => $faker->name,
                'email'    => $faker->unique()->safeEmail,
                'password' => app('hash')->make('123456'),
                'email_verified_at' => Carbon::parse($date)->addHour(rand(1, 12)),
                'created_at'  => $date,
                'updated_at'  => Carbon::parse($date)->addDay(rand(1, 28))->addHour(rand(1, 12))
            ])->perfis()->sync([4]);
        }
    }
}
