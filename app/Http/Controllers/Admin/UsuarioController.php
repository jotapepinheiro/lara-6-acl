<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsuarioController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $auth = Auth::user()->hasPerfil('super', 'admin');

        if((!$auth)){
            return view('home');
        }else{
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $usuarios = Usuario::where('name', 'LIKE', "%$keyword%")
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
        $auth = Auth::user()->hasPerfil('super', 'admin');

        if((!$auth)){
            return view('home');
        }else{
            return view('admin.usuarios.create');
        }
    }

    public function store(Request $request)
    {
        $auth = Auth::user()->hasPerfil('super', 'admin');

        if((!$auth)){
            return view('home');
        }else{

            $requestData = $request->all();

            Usuario::create($requestData);

            return redirect('admin/usuarios')->with('flash_message', 'Usuário adicionado!');
        }
    }

    public function show($id)
    {
        $auth = Auth::user()->hasPerfil('super', 'admin');

        if((!$auth)){
            return view('home');
        }else{
            $usuario = Usuario::findOrFail($id);

            return view('admin.usuarios.show', compact('usuario'));
        }
    }

    public function edit($id)
    {
        $auth = Auth::user()->hasPerfil('super', 'admin');

        if((!$auth)){
            return view('home');
        }else{
            $usuario = Usuario::findOrFail($id);

            return view('admin.usuarios.edit', compact('usuario'));
        }
    }

    public function update(Request $request, $id)
    {
        $auth = Auth::user()->hasPerfil('super', 'admin');

        if((!$auth)){
            return view('home');
        }else{

            $requestData = $request->all();

            $usuario = Usuario::findOrFail($id);
            $usuario->update($requestData);

            return redirect('admin/usuarios')->with('flash_message', 'Usuário atualizado!');
        }
    }

    public function destroy($id)
    {
        $auth = Auth::user()->hasPerfil('super', 'admin');

        if((!$auth)){
            return view('home');
        }else{
            Usuario::destroy($id);

            return redirect('admin/usuarios')->with('flash_message', 'Usuário deletado!');
        }
    }
}
