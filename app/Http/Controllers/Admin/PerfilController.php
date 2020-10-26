<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Model\Acl\Perfil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PerfilController extends Controller
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
                $perfis = Perfil::where('nome', 'LIKE', "%$keyword%")
                ->orWhere('slug', 'LIKE', "%$keyword%")
                ->orderBy('id')
                ->latest()->paginate($perPage);
            } else {
                $perfis = Perfil::orderBy('id')->latest()->paginate($perPage);
            }

            return view('admin.perfis.index', compact('perfis'));
        }
    }

    public function create()
    {
        $auth = Auth::user()->hasPerfil('super', 'admin');

        if((!$auth)){
            return view('home');
        }else{
            return view('admin.perfis.create');
        }
    }

    public function store(Request $request)
    {
        $auth = Auth::user()->hasPerfil('super', 'admin');

        if((!$auth)){
            return view('home');
        }else{

            $requestData = $request->all();

            Perfil::create($requestData);

            return redirect('admin/perfis')->with('flash_message', 'Perfil adicionado!');
        }
    }

    public function show($id)
    {
        $auth = Auth::user()->hasPerfil('super', 'admin');

        if((!$auth)){
            return view('home');
        }else{
            $perfil = Perfil::findOrFail($id);

            return view('admin.perfis.show', compact('perfil'));
        }
    }

    public function edit($id)
    {
        $auth = Auth::user()->hasPerfil('super', 'admin');

        if((!$auth)){
            return view('home');
        }else{
            $perfil = Perfil::findOrFail($id);

            return view('admin.perfis.edit', compact('perfil'));
        }
    }

    public function update(Request $request, $id)
    {
        $auth = Auth::user()->hasPerfil('super', 'admin');

        if((!$auth)){
            return view('home');
        }else{

            $requestData = $request->all();

            $perfil = Perfil::findOrFail($id);
            $perfil->update($requestData);

            return redirect('admin/perfis')->with('flash_message', 'Perfil atualizado!');
        }
    }

    public function destroy($id)
    {
        $auth = Auth::user()->hasPerfil('super', 'admin');

        if((!$auth)){
            return view('home');
        }else{
            Perfil::destroy($id);

            return redirect('admin/perfis')->with('flash_message', 'Perfil deletado!');
        }
    }
}
