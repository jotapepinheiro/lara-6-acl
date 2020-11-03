<?php

namespace App\Http\Controllers\Admin;

use App\Facades\AclFacade as Acl;
use App\Http\Controllers\Controller;

use App\Model\Acl\Modulo;
use App\Model\Acl\Permissao;
use App\Model\Acl\Tela;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TelaController extends Controller
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
                $telas = Tela::with('modulo')->where('nome', 'LIKE', "%$keyword%")
                ->orWhere('slug', 'LIKE', "%$keyword%")
                ->orderBy('id')
                ->latest()->paginate($perPage);
            } else {
                $telas = Tela::with('modulo')->orderBy('id')->latest()->paginate($perPage);
            }

            return view('admin.telas.index', compact('telas'));
        }
    }

    public function create()
    {
        $auth = Acl::hasRole(['super', 'admin']);

        if((!$auth)){
            return view('home');
        }else{
            $permissoes = Permissao::all('id', 'nome', 'descricao');
            $modulos = Modulo::all('id', 'nome', 'descricao');

            return view('admin.telas.create',  compact('permissoes', 'modulos'));
        }
    }

    public function store(Request $request)
    {
        $auth = Acl::hasRole(['super', 'admin']);

        if((!$auth)){
            return view('home');
        }else{

            $validator = Validator::make($request->all(), [
                'nome' => 'required|max:255',
                'slug' => 'required|unique:telas'
            ]);

            if ($validator->fails()) {
                return redirect('admin/telas')
                    ->withErrors($validator)
                    ->withInput();
            }

            $tela = Tela::create([
                'modulo_id' => $request->input('modulo_id'),
                'nome' => $request->input('nome'),
                'slug' => $request->input('slug'),
                'descricao' => $request->input('descricao')
            ]);

            if ($request->has('permissoes')) {
                foreach ($request->input('permissoes') as $key => $value) {
                    $tela->attachPermission($value);
                }
            }

            return redirect('admin/telas')->with('flash_message', 'Módulo adicionado!');
        }
    }

    public function show($id)
    {
        $auth = Acl::hasRole(['super', 'admin']);

        if((!$auth)){
            return view('home');
        }else{
            $tela = Tela::with('permissoes')->findOrFail($id);

            return view('admin.telas.show', compact('tela'));
        }
    }

    public function edit($id)
    {
        $auth = Acl::hasRole(['super', 'admin']);

        if((!$auth)){
            return view('home');
        }else{
            $tela = Tela::findOrFail($id);
            $permissoes = Permissao::all('id', 'nome');
            $tela_permissoes = $tela->permissoes->pluck('id')->toArray();
            $modulos = Modulo::all('id', 'nome', 'descricao');

            return view('admin.telas.edit', compact('tela', 'permissoes', 'tela_permissoes', 'modulos'));
        }
    }

    public function update(Request $request, $id)
    {
        $auth = Acl::hasRole(['super', 'admin']);

        if((!$auth)){
            return view('home');
        }else{
            $inputTela = $request->only('nome', 'slug', 'descricao');

            $validator = Validator::make($inputTela, [
                'nome' => 'required|max:255',
                'slug' => 'required|unique:telas,slug,' . $id
            ]);

            if ($validator->fails()) {
                return redirect('admin/telas')
                    ->withErrors($validator)
                    ->withInput();
            }

            $tela = Tela::findOrFail($id);
            $tela->update($inputTela);

            $tela->permissoes()->sync([]);
            if ($request->has('permissoes')) {
                foreach ($request->input('permissoes') as $key => $value) {
                    $tela->attachPermission($value);
                }
            }

            return redirect('admin/telas')->with('flash_message', 'Tela atualizada!');
        }
    }

    public function destroy($id)
    {
        $auth = Acl::hasRole(['super', 'admin']);

        if((!$auth)){
            return view('home');
        }else{
            Tela::destroy($id);

            return redirect('admin/telas')->with('flash_message', 'Tela deletada!');
        }
    }
}
