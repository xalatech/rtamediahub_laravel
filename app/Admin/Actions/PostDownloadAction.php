<?php

namespace App\Admin\Actions;

use App\Post;
use Encore\Admin\Actions\RowAction;

class PostDownloadAction extends RowAction
{

    public function handle(Post $post)
    {
        $post->dwonload_count = $post->download_count + 1;
        $post->save();

        $assets = asset('uploads');
        $html =  "<a href='" . $assets . $post->upload_url . '?Download=true' . "' class='text-muted'><i class='fa fa-download'></i></a>";

        return $this->response()->html($html);
    }

    public function display($download_url)
    {
        $assets = asset('uploads');
        return "<a href='" . $assets . $download_url . '?Download=true' . "' class='text-muted'><i class='fa fa-download'></i></a>";
    }
}
