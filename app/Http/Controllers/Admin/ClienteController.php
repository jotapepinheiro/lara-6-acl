<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Model\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClienteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $auth = Auth::user()->hasPerfil('super', 'manager', 'user');

        if((!$auth)){
            return view('home');
        }else{
            $keyword = $request->get('search');
            $perPage = 5;

            if (!empty($keyword)) {
                $clientes = Cliente::where('name', 'LIKE', "%$keyword%")
                ->orWhere('email', 'LIKE', "%$keyword%")
                ->orderBy('id')->latest()->paginate($perPage);
            } else {
                $clientes = Cliente::orderBy('id')->latest()->paginate($perPage);
            }

            return view('admin.clientes.index', compact('clientes'));
        }
    }

    public function create()
    {
        $auth = Auth::user()->hasPerfil('super', 'manager');

        if((!$auth)){
            return view('home');
        }else{
            return view('admin.clientes.create');
        }
    }

    public function store(Request $request)
    {
        $auth = Auth::user()->hasPerfil('super', 'manager');

        if((!$auth)){
            return view('home');
        }else{

            $requestData = $request->all();

            Cliente::create($requestData);

            return redirect('admin/clientes')->with('flash_message', 'Cliente adicionado!');
        }
    }

    public function show($id)
    {
        $auth = Auth::user()->hasPerfil('super', 'manager');

        if((!$auth)){
            return view('home');
        }else{
            $cliente = Cliente::findOrFail($id);

            return view('admin.clientes.show', compact('cliente'));
        }
    }

    public function edit($id)
    {
        $auth = Auth::user()->hasPerfil('super', 'manager');

        if((!$auth)){
            return view('home');
        }else{
            $cliente = Cliente::findOrFail($id);

            return view('admin.clientes.edit', compact('cliente'));
        }
    }

    public function update(Request $request, $id)
    {
        $auth = Auth::user()->hasPerfil('super', 'manager');

        if((!$auth)){
            return view('home');
        }else{

            $requestData = $request->all();

            $cliente = Cliente::findOrFail($id);
            $cliente->update($requestData);

            return redirect('admin/clientes')->with('flash_message', 'Cliente atualizado!');
        }
    }

    public function destroy($id)
    {
        $auth = Auth::user()->hasPerfil('super', 'manager');

        if((!$auth)){
            return view('home');
        }else{
            Cliente::destroy($id);

            return redirect('admin/clientes')->with('flash_message', 'Cliente deletado!');
        }
    }
}
