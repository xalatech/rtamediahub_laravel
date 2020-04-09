<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Post;
use Cache;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

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
    public function index(Request $request)
    {
        if (Auth::user()->id) {
            $data = $this->getHomeData($request);

            return view('home', $data);
        }

        return view('home');
    }

    public function getHomeData($request)
    {
        $categories = Category::query()->where('published', true)->latest()->get();
        $featured = Category::query()->where('featured', true)->latest()->get();

        if ($request->user()->hasRole('administrator') || $request->user()->hasRole('manager')) {
            $posts_today = Post::query()->where('published', true)->whereDate('created_at', Carbon::today())->latest()->get();
            $posts_other = Post::query()->where('published', true)->whereDate('created_at', '!=', Carbon::today())->latest()->get();
            $posts = Post::query()->where('published', true)->latest()->get();
        } else {
            $posts_today = Post::query()->where('published', true)->where('user_id', Auth::user()->id)->whereDate('created_at', Carbon::today())->latest()->get();
            $posts_other = Post::query()->where('published', true)->where('user_id', Auth::user()->id)->whereDate('created_at', '!=', Carbon::today())->latest()->get();
            $posts = Post::query()->where('published', true)->where('user_id', Auth::user()->id)->latest()->get();
        }

        $data['categories'] = $categories;
        $data['featured'] = $featured;
        $data['posts_today'] = $posts_today;
        $data['posts_other'] = $posts_other;
        $data['posts'] = $posts;

        return $data;
    }
}
