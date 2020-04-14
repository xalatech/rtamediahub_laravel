<?php

namespace App\Admin\Actions;

use App\Post;
use Encore\Admin\Actions\RowAction;
use App\User;
use App\Notifications\NewMediaUploaded;

class PostAction extends RowAction
{
    // After the page clicks on the chart in this column, send the request to the backend handle method to execute
    public function handle(Post $post)
    {
        $post->published = (int) !$post->published;
        $post->save();

        if ($post->published) {
            $query = User::query();
            $users_to_notify = $query->where('notifications', true)->get();

            foreach ($users_to_notify as $user) {
                $user->notify(new NewMediaUploaded($post));
            }
        }

        $html = $post->published ? "<i class='fa fa-check text-green'></i>" : "<i class='fa fa-close text-red'></i>";

        return $this->response()->html($html);
    }

    // This method displays different icons in this column based on the value of the `star` field.
    public function display($published)
    {
        return $published ? "<i class='fa fa-check text-green'></i>" : "<i class='fa fa-close text-red'></i>";
    }
}
