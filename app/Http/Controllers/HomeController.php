<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Post;
use Cache;
use Illuminate\Support\Carbon;

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
        $featured = Category::query()->where('featured', true)->orderBy('sort_order', 'asc')->get();
        $posts_today = Post::query()->where('published', true)->whereDate('created_at', Carbon::today())->orderBy('created_at', 'desc')->get();
        $posts_other = Post::query()->where('published', true)->whereDate('created_at', '!=', Carbon::today())->orderBy('created_at', 'desc')->get();
        $posts = Post::query()->where('published', true)->orderBy('created_at', 'desc')->get();

        $data['categories'] = $categories;
        $data['featured'] = $featured;
        $data['posts_today'] = $posts_today;
        $data['posts_other'] = $posts_other;
        $data['posts'] = $posts;

        return view('home', $data);
    }
}
