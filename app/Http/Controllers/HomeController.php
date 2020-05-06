<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Post;
use Cache;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $data = $this->getHomeData($request);

        return view('home', $data);

        return view('home');
    }

    public function getHomeData($request)
    {
        $categories = Category::query()->where('published', true)->latest()->get();
        $featured = Category::query()->where('featured', true)->latest()->get();
        $posts_today = Post::query()->where('published', true)->whereDate('created_at', Carbon::today())->latest()->get();
        $posts_other = Post::query()->where('published', true)->whereDate('created_at', '!=', Carbon::today())->latest()->get();
        $posts = Post::query()->where('published', true)->latest()->get();

        $data['categories'] = $categories;
        $data['featured'] = $featured;
        $data['posts_today'] = $posts_today;
        $data['posts_other'] = $posts_other;
        $data['posts'] = $posts;
        $data['media_url'] = 'https://' . config('filesystems.disks.azure.name') . '.blob.core.windows.net/' . config('filesystems.disks.azure.container') . '/';

        return $data;
    }
}
