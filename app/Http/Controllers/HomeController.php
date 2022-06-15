<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ProjectSummary;

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
    public function index()
    {
        $res = ProjectSummary::get();
        return view('home',["Projects" => $res]);
    }

    public function get_details()
    {
        # code...
    }
}
