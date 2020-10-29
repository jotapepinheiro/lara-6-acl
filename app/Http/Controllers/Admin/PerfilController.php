<?php

namespace App\Http\Controllers\Admin;

use App\Facades\AclFacade as Acl;
use App\Http\Controllers\Controller;

use App\Model\Acl\Perfil;
use App\Model\Acl\Permissao;
use Illuminate\Http\Request;

class PerfilController extends Controller
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
        $auth = Acl::hasRole(['super', 'admin']);

        if((!$auth)){
            return view('home');
        }else{
            $permissoes = Permissao::all('id', 'nome');
            $perfil_permissoes = array();

            return view('admin.perfis.create',  compact('permissoes', 'perfil_permissoes'));
        }
    }

    public function store(Request $request)
    {
        $auth = Acl::hasRole(['super', 'admin']);

        if((!$auth)){
            return view('home');
        }else{

            $perfil = Perfil::create([
                'nome' => $request->input('nome'),
                'slug' => $request->input('slug'),
                'descricao' => $request->input('descricao')
            ]);

            if ($request->has('permissoes')) {
                foreach ($request->input('permissoes') as $key => $value) {
                    $perfil->attachPermission($value);
                }
            }

            return redirect('admin/perfis')->with('flash_message', 'Perfil adicionado!');
        }
    }

    public function show($id)
    {
        $auth = Acl::hasRole(['super', 'admin']);

        if((!$auth)){
            return view('home');
        }else{
            $perfil = Perfil::with('permissoes')->findOrFail($id);

            return view('admin.perfis.show', compact('perfil'));
        }
    }

    public function edit($id)
    {
        $auth = Acl::hasRole(['super', 'admin']);

        if((!$auth)){
            return view('home');
        }else{
            $perfil = Perfil::findOrFail($id);
            $permissoes = Permissao::all('id', 'nome');
            $perfil_permissoes = $perfil->permissoes->pluck('id')->toArray();

            return view('admin.perfis.edit', compact('perfil', 'permissoes', 'perfil_permissoes'));
        }
    }

    public function update(Request $request, $id)
    {
        $auth = Acl::hasRole(['super', 'admin']);

        if((!$auth)){
            return view('home');
        }else{
            $inputPerfil = $request->only('nome', 'slug', 'descricao');

            $role = Perfil::findOrFail($id);
            $role->update($inputPerfil);

            $role->permissoes()->sync([]);
            if ($request->has('permissoes')) {
                foreach ($request->input('permissoes') as $key => $value) {
                    $role->attachPermission($value);
                }
            }

            return redirect('admin/perfis')->with('flash_message', 'Perfil atualizado!');
        }
    }

    public function destroy($id)
    {
        $auth = Acl::hasRole(['super', 'admin']);

        if((!$auth)){
            return view('home');
        }else{
            Perfil::destroy($id);

            return redirect('admin/perfis')->with('flash_message', 'Perfil deletado!');
        }
    }
}
