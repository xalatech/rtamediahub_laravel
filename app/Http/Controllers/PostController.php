<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Category;
use App\Notifications\NewMediaUploaded;
use Illuminate\Support\Str;
use App\Services\Slug;
use FFMpeg\FFMpeg;
use FFMpeg\FFMpeg\Coordinate;
use FFMpeg\Format\Video\X264;
use Intervention\Image\Facades\Image as Image;
use Pawlox\VideoThumbnail\Facade\VideoThumbnail;
use Illuminate\Support\Carbon;
use MicrosoftAzure\Storage\Common\Internal\StorageServiceSettings;
use Illuminate\Support\Facades\Storage;
use Matthewbdaly\LaravelAzureStorage\AzureBlobStorageAdapter;
use MicrosoftAzure\Storage\Blob\BlobRestProxy;

class PostController extends Controller
{

    public function __construct(Slug $slug)
    {
        $this->slug = $slug;
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
        $media_type = 'image';
        $disk = Storage::disk('azure');
        $output = "";

        if ($request->hasFile('upload_url')) {
            $file = $request->file('upload_url');
            $name = time() . '.' . $file->getClientOriginalExtension();
            $upload_url = $name;

            if (substr($file->getMimeType(), 0, 5) == 'image') {
                $folder = '/images';
                $upload_url = $disk->put($folder, $file);
                $media_type = 'image';
                $output =  $this->createNewPost($request, $upload_url, $media_type);
            } else if (substr($file->getMimeType(), 0, 5) == 'video') {
                $folder = '/videos';
                $destinationPath = public_path('/uploads/videos');
                $file->move($destinationPath, $name);
  
                $output = "Original size: ".$file->getSize();

                $video = $ffmpeg->open($destinationPath . $name);
                $format = new X264();
                $format->setKiloBitrate(1000)->setAudioChannels(2)->setAudioKiloBitrate(256);

                $video->save($format, $destinationPath . $name);

                $output .= "Compressed size: ".$video->getSize();

                $upload_url = $disk->put($folder, $video);


                $media_type = 'video';
                $output = $this->createNewPost($request, $upload_url, $media_type, $output);
            }
        }

        return response()->json($output);
    }

    public function createNewPost(Request $request, $upload_url, $media_type, $output)
    {
        $slug = $this->slug->createSlug($request->get('headline'));

        $post = new Post([
            'headline' => $request->get('headline'),
            'description' => $request->get('description'),
            'category_id' => $request->get('category_id'),
            'tags' => $request->get('tags'),
            'slug' => $slug,
            'upload_url' => $upload_url,
            'thumb_url' => $upload_url,
            'media_type' => $media_type,
            'published' => false
        ]);

        $post->save();

        $output = array(
            'success' => 'Media uploaded successfully: '.$output,
        );

        return $output;
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

    public function download(Request $request)
    {
        $post_id = $request->input('post_id');
        $post = Post::find($post_id);
        $post->download_count = $post->download_count + 1;
        $post->save();
    }

    public function search(Request $request)
    {
        $category = $request->input('category');
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');
        $keyword = $request->input('keyword');

        $query = Post::query();
        $query2 = Post::query();

        if (isset($category)) {
            $query->where('category_id', $category);
            $query2->where('category_id', $category);
        }

        if (isset($keyword)) {
            $query->where('headline', 'like', '%' . $keyword . '%');
            $query2->where('headline', 'like', '%' . $keyword . '%');
        }

        $posts_other = $query2->where('published', true)->whereDate('created_at', '!=', Carbon::today())->orderBy('created_at', 'desc')->get();
        $posts_today = $query->where('published', true)->whereDate('created_at', Carbon::today())->orderBy('created_at', 'desc')->get();

        $collection['posts_today'] = $posts_today;
        $collection['posts_other'] = $posts_other;

        return view('post_list', $collection);
    }

    /*  public function Seed(Request $request)
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
            $post->media_type = 'image';
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
            $post->media_type = 'image';

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
            $post->media_type = 'image';

            $post->published = true;

            $category = Category::where('name', 'Breaking news')->first();
            $post->category_id = $category->id;

            $post->save();

            $post = new Post();
            $post->headline = 'Video test';
            $post->description = 'video test';
            $post->slug = 'ashraf-ghani-wins-election';
            $post->tags = '#ashrafghani #election #afghanistan';
            $post->upload_url = '/videos/video5.mp4';
            $post->thumb_url = '/videos/video5.mp4';
            $post->media_type = 'video';
            $post->published = true;

            $category = Category::where('name', 'Corona Virus')->first();
            $post->category_id = $category->id;

            $post->save();

            $post = new Post();
            $post->headline = 'Video test';
            $post->description = 'video test';
            $post->slug = 'ashraf-ghani-wins-election';
            $post->tags = '#ashrafghani #election #afghanistan';
            $post->upload_url = '/videos/video4.mp4';
            $post->thumb_url = '/videos/video4.mp4';
            $post->media_type = 'video';
            $post->published = true;
            $post->created_at = Carbon::yesterday();

            $category = Category::where('name', 'Corona Virus')->first();
            $post->category_id = $category->id;

            $post->save();

            $post = new Post();
            $post->headline = 'Video test';
            $post->description = 'video test';
            $post->slug = 'ashraf-ghani-wins-election';
            $post->tags = '#ashrafghani #election #afghanistan';
            $post->upload_url = '/videos/video3.mp4';
            $post->thumb_url = '/videos/video3.mp4';
            $post->media_type = 'video';
            $post->published = true;
            $post->created_at = Carbon::create(2020, 4, 1, 0);

            $category = Category::where('name', 'Corona Virus')->first();
            $post->category_id = $category->id;

            $post->save();

            $post = new Post();
            $post->headline = 'Video test';
            $post->description = 'video test';
            $post->slug = 'ashraf-ghani-wins-election';
            $post->tags = '#ashrafghani #election #afghanistan';
            $post->upload_url = '/videos/video2.mp4';
            $post->thumb_url = '/videos/video2.mp4';
            $post->media_type = 'video';
            $post->published = true;
            $post->created_at = Carbon::create(2020, 4, 2, 0);


            $category = Category::where('name', 'Corona Virus')->first();
            $post->category_id = $category->id;

            $post->save();

            $post = new Post();
            $post->headline = 'Video test';
            $post->description = 'video test';
            $post->slug = 'ashraf-ghani-wins-election';
            $post->tags = '#ashrafghani #election #afghanistan';
            $post->upload_url = '/videos/video1.mp4';
            $post->thumb_url = '/videos/video1.mp4';
            $post->media_type = 'video';
            $post->published = true;

            $category = Category::where('name', 'Corona Virus')->first();
            $post->category_id = $category->id;

            $post->save();
        }


        return redirect()->back();
    } */
}
