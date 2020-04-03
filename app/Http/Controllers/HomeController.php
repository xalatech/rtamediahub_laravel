<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Post;
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
        $categories = Category::query()->where('published', true)->orderBy('sort_order', 'asc')->get();
        $posts = Post::query()->where('published', true)->orderBy('created_at', 'desc')->get();

        $data['categories'] = $categories;
        $data['posts'] = $posts;

        return view('home', $data);
    }
}
