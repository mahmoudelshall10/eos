<?php

namespace App\Http\Controllers\Normaluser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserHomeController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:user.home',['only' => ['index']]);
    }

    public function index()
    {
        return view('nUsers.nUserHome');
    }   
}
