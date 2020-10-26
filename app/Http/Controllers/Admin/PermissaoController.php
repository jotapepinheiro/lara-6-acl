<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Permissao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PermissaoController extends Controller
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
            $perPage = 5;

            if (!empty($keyword)) {
                $permissoes = Permissao::where('nome', 'LIKE', "%$keyword%")
                ->orWhere('slug', 'LIKE', "%$keyword%")
                ->orderBy('id')->latest()->paginate($perPage);
            } else {
                $permissoes = Permissao::orderBy('id')->latest()->paginate($perPage);
            }

            return view('admin.permissoes.index', compact('permissoes'));
        }
    }

    public function create()
    {
        $auth = Auth::user()->hasPerfil('super', 'admin');

        if((!$auth)){
            return view('home');
        }else{
            return view('admin.permissoes.create');
        }
    }

    public function store(Request $request)
    {
        $auth = Auth::user()->hasPerfil('super', 'admin');

        if((!$auth)){
            return view('home');
        }else{

            $requestData = $request->all();

            Permissao::create($requestData);

            return redirect('admin/permissoes')->with('flash_message', 'Permissão adicionada!');
        }
    }

    public function show($id)
    {
        $auth = Auth::user()->hasPerfil('super', 'admin');

        if((!$auth)){
            return view('home');
        }else{
            $permissao = Permissao::findOrFail($id);

            return view('admin.permissoes.show', compact('permissao'));
        }
    }

    public function edit($id)
    {
        $auth = Auth::user()->hasPerfil('super', 'admin');

        if((!$auth)){
            return view('home');
        }else{
            $permissao = Permissao::findOrFail($id);

            return view('admin.permissoes.edit', compact('permissao'));
        }
    }

    public function update(Request $request, $id)
    {
        $auth = Auth::user()->hasPerfil('super', 'admin');

        if((!$auth)){
            return view('home');
        }else{

            $requestData = $request->all();

            $permissao = Permissao::findOrFail($id);
            $permissao->update($requestData);

            return redirect('admin/permissoes')->with('flash_message', 'Permissão atualizada!');
        }
    }

    public function destroy($id)
    {
        $auth = Auth::user()->hasPerfil('super', 'admin');

        if((!$auth)){
            return view('home');
        }else{
            Permissao::destroy($id);

            return redirect('admin/permissoes')->with('flash_message', 'Permissão deletada!');
        }
    }
}
