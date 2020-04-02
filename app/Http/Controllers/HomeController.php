<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Cache;

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
        $categories = Category::all();
        //$categories->orderBy('sort_order', 'asc');

        return view('home', $categories);
    }
}
