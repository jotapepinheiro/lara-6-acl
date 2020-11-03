<?php

namespace App\Http\Controllers\Admin;

use App\Facades\AclFacade as Acl;
use App\Http\Controllers\Controller;

use App\Model\Acl\Modulo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
                $modulos = Modulo::with('pai')->where('nome', 'LIKE', "%$keyword%")
                ->orWhere('slug', 'LIKE', "%$keyword%")
                ->orderBy('id')
                ->latest()->paginate($perPage);
            } else {
                $modulos = Modulo::with('pai')->orderBy('id')->latest()->paginate($perPage);
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
            $modulos = Modulo::all('id', 'nome', 'descricao');

            return view('admin.modulos.create', compact('modulos'));
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
                'slug' => 'required|unique:modulos'
            ]);

            if ($validator->fails()) {
                return redirect('admin/modulos')
                    ->withErrors($validator)
                    ->withInput();
            }

            Modulo::create([
                'modulo_id' => $request->input('modulo_id'),
                'nome' => $request->input('nome'),
                'slug' => $request->input('slug'),
                'descricao' => $request->input('descricao')
            ]);

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
            $modulo = Modulo::with('telas.permissoes')->findOrFail($id);
            $modulos = Modulo::all('id', 'nome', 'descricao');

            return view('admin.modulos.edit', compact('modulo', 'modulos'));
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
                'slug' => 'required|unique:modulos,slug,' . $id
            ]);

            if ($validator->fails()) {
                return redirect('admin/modulos')
                    ->withErrors($validator)
                    ->withInput();
            }

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
