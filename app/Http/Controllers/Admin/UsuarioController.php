<?php

namespace App\Http\Controllers\Admin;

use App\Facades\AclFacade as Acl;
use App\Http\Controllers\Controller;
use App\Model\Acl\Perfil;
use App\Model\Acl\Permissao;
use App\Model\Acl\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $auth = Acl::hasRole(['super', 'admin']);

        if((!$auth)){
            return view('home');
        }else{
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $usuarios = Usuario::where('nome', 'LIKE', "%$keyword%")
                ->orWhere('email', 'LIKE', "%$keyword%")
                ->orWhere('password', 'LIKE', "%$keyword%")
                ->orderBy('id')
                ->latest()->paginate($perPage);
            } else {
                $usuarios = Usuario::orderBy('id')->latest()->paginate($perPage);
            }

            return view('admin.usuarios.index', compact('usuarios'));
        }
    }

    public function create()
    {
        $auth = Acl::hasRole(['super', 'admin']);

        if((!$auth)){
            return view('home');
        }else{
            $perfis = Perfil::all('id', 'nome', 'descricao');
            $permissoes = Permissao::all('id', 'nome', 'descricao');

            return view('admin.usuarios.create', compact('perfis', 'permissoes'));
        }
    }

    public function store(Request $request)
    {
        $auth = Acl::hasRole(['super', 'admin']);

        if((!$auth)){
            return view('home');
        }else{

            $inputUser = $request->only('nome', 'email', 'telefone', 'status', 'password');
            $inputUser['password'] = app('hash')->make($inputUser['password']);

            $usuario = Usuario::create($inputUser);

            if ($request->has('perfis')) {
                foreach ($request->input('perfis') as $key => $value) {
                    $usuario->attachRole($value);
                }
            }

            if ($request->has('permissoes')) {
                foreach ($request->input('permissoes') as $key => $value) {
                    $usuario->attachPermission($value);
                }
            }

            return redirect('admin/usuarios')->with('flash_message', 'Usuário adicionado!');
        }
    }

    public function show($id)
    {
        $auth = Acl::hasRole(['super', 'admin']);

        if((!$auth)){
            return view('home');
        }else{
            $usuario = Usuario::with(['perfis.permissoes', 'permissoes'])->findOrFail($id);

            return view('admin.usuarios.show', compact('usuario'));
        }
    }

    public function edit($id)
    {
        $auth = Acl::hasRole(['super', 'admin']);

        if((!$auth)){
            return view('home');
        }else{
            $usuario = Usuario::with(['perfis', 'permissoes'])->findOrFail($id);
            $usuario_perfis = $usuario->perfis->pluck('id')->toArray();
            $usuario_permissoes = $usuario->permissoes->pluck('id')->toArray();
            $perfis = Perfil::all('id', 'nome', 'descricao');
            $permissoes = Permissao::all('id', 'nome', 'descricao');

            return view('admin.usuarios.edit', compact('usuario', 'perfis', 'permissoes', 'usuario_perfis', 'usuario_permissoes'));
        }
    }

    public function update(Request $request, $id)
    {
        $auth = Acl::hasRole(['super', 'admin']);

        if((!$auth)){
            return view('home');
        }else{

            $inputUser = $request->only('nome', 'email', 'telefone', 'status',  'password');
            $inputUser['password'] = app('hash')->make($inputUser['password']);

            $usuario = Usuario::findOrFail($id);
            $usuario->update($inputUser);

            $usuario->perfis()->sync([]);
            if ($request->has('perfis')) {
                foreach ($request->input('perfis') as $key => $value) {
                    $usuario->attachRole($value);
                }
            }

            $usuario->permissoes()->sync([]);
            if ($request->has('permissoes')) {
                foreach ($request->input('permissoes') as $key => $value) {
                    $usuario->attachPermission($value);
                }
            }

            return redirect('admin/usuarios')->with('flash_message', 'Usuário atualizado!');
        }
    }

    public function destroy($id)
    {
        $auth = Acl::hasRole(['super', 'admin']);

        if((!$auth)){
            return view('home');
        }else{
            Usuario::destroy($id);

            return redirect('admin/usuarios')->with('flash_message', 'Usuário deletado!');
        }
    }
}
