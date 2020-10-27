<?php

namespace App\Http\Controllers;

use App\Facades\AclFacade as Acl;

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
        $super = Acl::hasRole('super');
        $admin = Acl::hasRole('admin');
        $manager = Acl::hasRole('manager');
        $user = Acl::hasRole('user');

        if($super || $admin) {
            return redirect('/admin/usuarios');
        }elseif($manager || $user) {
            return redirect('/admin/clientes');
        }else{
            return view('home');
        }
    }
}
