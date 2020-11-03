<?php

namespace App\Http\Controllers\Admin;

use App\Facades\AclFacade as Acl;
use App\Http\Controllers\Controller;

use App\Model\Acl\Permissao;
use App\Model\Acl\Tela;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PermissaoController extends Controller
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
            $perPage = 5;

            if (!empty($keyword)) {
                $permissoes = Permissao::with('tela')->where('nome', 'LIKE', "%$keyword%")
                ->orWhere('slug', 'LIKE', "%$keyword%")
                ->orderBy('id')->latest()->paginate($perPage);
            } else {
                $permissoes = Permissao::with('tela')->orderBy('id')->latest()->paginate($perPage);
            }

            return view('admin.permissoes.index', compact('permissoes'));
        }
    }

    public function create()
    {
        $auth = Acl::hasRole(['super', 'admin']);

        if((!$auth)){
            return view('home');
        }else{
            $telas = Tela::all('id', 'nome', 'descricao');

            return view('admin.permissoes.create', compact('telas'));
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
                'slug' => 'required|unique:permissoes'
            ]);

            if ($validator->fails()) {
                return redirect('admin/permissoes')
                    ->withErrors($validator)
                    ->withInput();
            }

            Permissao::create([
                'tela_id' => $request->input('tela_id'),
                'nome' => $request->input('nome'),
                'slug' => $request->input('slug'),
                'descricao' => $request->input('descricao')
            ]);

            return redirect('admin/permissoes')->with('flash_message', 'Permissão adicionada!');
        }
    }

    public function show($id)
    {
        $auth = Acl::hasRole(['super', 'admin']);

        if((!$auth)){
            return view('home');
        }else{
            $permissao = Permissao::with('tela')->findOrFail($id);

            return view('admin.permissoes.show', compact('permissao'));
        }
    }

    public function edit($id)
    {
        $auth = Acl::hasRole(['super', 'admin']);

        if((!$auth)){
            return view('home');
        }else{
            $permissao = Permissao::with('tela')->findOrFail($id);
            $telas = Tela::all('id', 'nome', 'descricao');

            return view('admin.permissoes.edit', compact('permissao', 'telas'));
        }
    }

    public function update(Request $request, $id)
    {
        $auth = Acl::hasRole(['super', 'admin']);

        if((!$auth)){
            return view('home');
        }else{

            $requestData = $request->all();

            $validator = Validator::make($requestData, [
                'nome' => 'required|max:255',
                'slug' => 'required|unique:permissoes,slug,' . $id
            ]);

            if ($validator->fails()) {
                return redirect('admin/permissoes')
                    ->withErrors($validator)
                    ->withInput();
            }

            $permissao = Permissao::findOrFail($id);
            $permissao->update($requestData);

            return redirect('admin/permissoes')->with('flash_message', 'Permissão atualizada!');
        }
    }

    public function destroy($id)
    {
        $auth = Acl::hasRole(['super', 'admin']);

        if((!$auth)){
            return view('home');
        }else{
            Permissao::destroy($id);

            return redirect('admin/permissoes')->with('flash_message', 'Permissão deletada!');
        }
    }
}
