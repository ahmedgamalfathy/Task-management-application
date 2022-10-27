<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\project;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(project $project)
    {
       // return view('home');
       return redirect('/projects/'. $project->id);
    }
}
