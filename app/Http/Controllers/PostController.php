<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use Illuminate\Support\Str;
use App\Services\Slug;
use Intervention\Image\Facades\Image as Image;

class PostController extends Controller
{

    public function __construct(Slug $slug)
    {
        $this->slug = $slug;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $data['categories'] = $categories;

        return view('post', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $upload_url = public_path('/images/default.png');

        if ($request->hasFile('upload_url')) {
            $file = $request->file('upload_url');
            $type = $file->getMimeType();
            $name = time() . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $file->move($destinationPath, $name);
            $upload_url = $name;
        }
        /* 
        if ($type == 'image/jpeg') {
            $thumb = Image::make(public_path('/images') . '/' . $name)->resize(320, 240)->insert(public_path('/images/rtalogo.png'));
        } */

        $slug = $this->slug->createSlug($request->get('headline'));

        $post = new Post([
            'headline' => $request->get('headline'),
            'description' => $request->get('description'),
            'category_id' => $request->get('category_id'),
            'tags' => $request->get('tags'),
            'slug' => $slug,
            'upload_url' => $upload_url,
            'thumb_url' => $upload_url
        ]);

        $post->save();

        return redirect('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function search(Request $request)
    {
        $category = $request->input('category');
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');
        $keyword = $request->input('keyword');

        $query = Post::query();

        if (isset($category)) {
            $query->where('category_id', $category);
        }

        if (isset($startDate) && isset($endDate)) {
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }

        if (isset($keyword)) {
            $query->where('headline', 'like', '%' . $keyword . '%');
        }

        $collection['posts'] = $query->get();

        return view('post_list', $collection);
    }
}
