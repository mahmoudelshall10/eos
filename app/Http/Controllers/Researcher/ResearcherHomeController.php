<?php

namespace App\Http\Controllers\Researcher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ResearcherHomeController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:researcher.home',['only' => ['index']]);
    }

    public function index()
    {
        return view('researchers.researcherHome');
    } 
}
