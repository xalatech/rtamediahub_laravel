<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use Illuminate\Support\Str;
use App\Services\Slug;
use Intervention\Image\Facades\Image as Image;
use Pawlox\VideoThumbnail\Facade\VideoThumbnail;

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
        $upload_url = 'default.png';

        if ($request->hasFile('upload_url')) {
            $file = $request->file('upload_url');
            $type = $file->getMimeType();
            $name = time() . '.' . $file->getClientOriginalExtension();

            if (substr($file->getMimeType(), 0, 5) == 'image') {
                $destinationPath = public_path('/uploads/images');
                $folder = '/images';
                $file->move($destinationPath, $name);
            } else if (substr($file->getMimeType(), 0, 5) == 'video') {
                $destinationPath = public_path('/uploads/videos');
                $folder = '/videos';
                $file->move($destinationPath, $name);

                $thumb = VideoThumbnail::createThumbnail(public_path($destinationPath . '/' . $name), public_path("uploads/thumbs/"), $name, 2, 240, 280);
                $thumb_folder = public_path('/uploads/thumbs');
            }


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
            'upload_url' => $folder . '/' . $upload_url,
            'thumb_url' => $thumb_folder . '/' . $name,
            'published' => false
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

    public function Seed(Request $request)
    {
        if ($request->user()->hasRole('administrator')) {

            $posts = Post::all();
            foreach ($posts as $post) {
                $post->delete();
            }

            $post = new Post();
            $post->headline = 'Shazad scored 50';
            $post->description = 'On 8 March 2016, <b>Shahzad</b> became the first associate player to <b>score</b> 10 <b>fifty</b>-plus scores in T20Is. With his <b>50</b> against Scotland in a group match of 2016 ICC World Twenty20, he achieved his 10th T20I <b>score</b> more than <b>fifty</b>.';
            $post->slug = 'shazad-scored-50';
            $post->tags = '#shahzad #fifty #cricket';
            $post->upload_url = '/images/1585933168.jpg';
            $post->thumb_url = '/images/1585933168.jpg';
            $post->published = true;

            $category = Category::where('name', 'Sports news')->first();
            $post->category_id = $category->id;

            $post->save();

            $post = new Post();
            $post->headline = 'shahpoor takes 2 wickets';
            $post->description = '<p>Shahpoor zadran takes two wickets</p>';
            $post->slug = 'shahpoor-takes-2-wickets';
            $post->tags = '#shahpoor #wickets #cricket';
            $post->upload_url = '/images/1585933937.jpg';
            $post->thumb_url = '/images/1585933937.jpg';
            $post->published = true;

            $category = Category::where('name', 'Sports news')->first();
            $post->category_id = $category->id;

            $post->save();

            $post = new Post();
            $post->headline = 'Ashraf ghani wins election';
            $post->description = 'Ghani declared winner of Afghan election - but opponent rejects result ... election authorities have declared the incumbent, Ashraf Ghani, the winner, but ... On Tuesday, election authorities said Ghani won 50.64% of the vote';
            $post->slug = 'ashraf-ghani-wins-election';
            $post->tags = '#ashrafghani #election #afghanistan';
            $post->upload_url = '/images/1585933904.jpg';
            $post->thumb_url = '/images/1585933937.jpg';
            $post->published = true;

            $category = Category::where('name', 'Breaking news')->first();
            $post->category_id = $category->id;

            $post->save();
        }


        return redirect()->back();
    }
}
