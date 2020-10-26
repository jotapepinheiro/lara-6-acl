<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('welcome');
    }

    public function home()
    {
        $super = Auth::user()->hasPerfil('super');
        $admin = Auth::user()->hasPerfil('admin');
        $manager = Auth::user()->hasPerfil('manager');
        $user = Auth::user()->hasPerfil('user');

        if($super || $admin) {
            return redirect('/admin/usuarios');
        }elseif($manager || $user) {
            return redirect('/admin/clientes');
        }else{
            return view('home');
        }
    }
}
