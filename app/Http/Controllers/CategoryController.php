<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function Seed(Request $request)
    {
        if ($request->user()->hasRole('administrator')) {

            $categories = Category::all();
            foreach ($categories as $cat) {
                echo $cat;
                $cat->delete();
            }

            $category = new Category();
            $category->name = 'Corona Virus';
            $category->description = 'Corona related news';
            $category->url = 'corona-news';
            $category->sort_order = 0;
            $category->icon = 'syringe';
            $category->published = true;

            $category->save();


            $category = new Category();
            $category->name = 'Breaking news';
            $category->description = 'Breaking related news';
            $category->url = 'breaking-news';
            $category->sort_order = 0;
            $category->icon = 'fire';
            $category->published = true;


            $category->save();

            $category = new Category();
            $category->name = 'Sports news';
            $category->description = 'Sports related news';
            $category->url = 'sport-news';
            $category->sort_order = 1;
            $category->icon = 'volleyball-ball';
            $category->published = true;

            $category->save();


            $category = new Category();
            $category->name = 'Business news';
            $category->description = 'Business related news';
            $category->url = 'business-news';
            $category->sort_order = 3;
            $category->icon = 'chart-bar';
            $category->published = true;

            $category->save();

            $category = new Category();
            $category->name = 'Technology news';
            $category->description = 'Technology related news';
            $category->url = 'tech-news';
            $category->sort_order = 4;
            $category->icon = 'sim-card';
            $category->published = true;

            $category->save();
        }

        return redirect()->back();
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
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!$request->user()->can('create-category')) {
            return redirect('/categories')->with('failed', 'You do not have permission to make category.');
        }

        $request->validate([
            'name' => 'required',
            'url' => 'required',
            'icon' => 'required',
            'sort_order' => 'required'
        ]);

        $category = new Category([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'url' => $request->get('url'),
            'icon' => $request->get('icon'),
            'sort_order' => $request->get('sort_order')
        ]);


        $category->save();
        return redirect('/categories')->with('success', 'Category saved!');
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
    public function destroy(Request $request, $id)
    {
        if (!$request->user()->can('create-category')) {
            return redirect('/categories')->with('failed', 'You do not have permission to delete category.');
        }
    }
}
