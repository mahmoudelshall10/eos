<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Model\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index()
    {
        $teams = Team::get();

        return view('site.team',compact('teams'));
    }
}
