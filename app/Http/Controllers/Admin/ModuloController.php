<?php

namespace App\Http\Controllers\Admin;

use App\Facades\AclFacade as Acl;
use App\Http\Controllers\Controller;

use App\Model\Acl\Modulo;
use App\Model\Acl\Permissao;
use App\Model\Acl\Tela;
use Illuminate\Http\Request;

class ModuloController extends Controller
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
                $modulos = Modulo::where('nome', 'LIKE', "%$keyword%")
                ->orWhere('slug', 'LIKE', "%$keyword%")
                ->orderBy('id')
                ->latest()->paginate($perPage);
            } else {
                $modulos = Modulo::orderBy('id')->latest()->paginate($perPage);
            }

            return view('admin.modulos.index', compact('modulos'));
        }
    }

    public function create()
    {
        $auth = Acl::hasRole(['super', 'admin']);

        if((!$auth)){
            return view('home');
        }else{
            $telas = Tela::all('id', 'nome');
            $permissoes = Permissao::all('id', 'nome');

            return view('admin.modulos.create', compact('telas', 'permissoes'));
        }
    }

    public function store(Request $request)
    {
        $auth = Acl::hasRole(['super', 'admin']);

        if((!$auth)){
            return view('home');
        }else{

            $modulo = Modulo::create([
                'nome' => $request->input('nome'),
                'slug' => $request->input('slug'),
                'descricao' => $request->input('descricao')
            ]);

//            foreach ($request->input('permissoes') as $key => $value) {
//                $modulo->attachPermission($value);
//            }

            return redirect('admin/modulos')->with('flash_message', 'Módulo adicionado!');
        }
    }

    public function show($id)
    {
        $auth = Acl::hasRole(['super', 'admin']);

        if((!$auth)){
            return view('home');
        }else{
            $modulo = Modulo::with('telas.permissoes')->findOrFail($id);

            return view('admin.modulos.show', compact('modulo'));
        }
    }

    public function edit($id)
    {
        $auth = Acl::hasRole(['super', 'admin']);

        if((!$auth)){
            return view('home');
        }else{
            $modulo = Modulo::with(['telas.permissoes'])->findOrFail($id);
            $modulo_telas = $modulo->telas->pluck('id')->toArray();

            $telas = Tela::all('id', 'nome');
            $permissoes = Permissao::all('id', 'nome');

            return view('admin.modulos.edit', compact('modulo', 'telas', 'permissoes', 'modulo_telas'));
        }
    }

    public function update(Request $request, $id)
    {
        $auth = Acl::hasRole(['super', 'admin']);

        if((!$auth)){
            return view('home');
        }else{

            $requestData = $request->all();

            $modulo = Modulo::findOrFail($id);
            $modulo->update($requestData);

            return redirect('admin/modulos')->with('flash_message', 'Módulo atualizado!');
        }
    }

    public function destroy($id)
    {
        $auth = Acl::hasRole(['super', 'admin']);

        if((!$auth)){
            return view('home');
        }else{
            Modulo::destroy($id);

            return redirect('admin/modulos')->with('flash_message', 'Módulo deletado!');
        }
    }
}
