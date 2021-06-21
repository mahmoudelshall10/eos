<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{

    use AuthenticatesUsers;


    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }



    public function index()
    {
        return view('admin.auth.login');
    }



    public function store(Request $request)
    {
        return $this->login($request);
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');

    }

    protected function redirectTo()
    {
        return route('admin.dashboards.index');
    }



}
