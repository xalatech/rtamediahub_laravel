<?php

namespace App\Admin\Controllers;

use App\Post;
use App\User;
use App\Category;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

use App\Admin\Actions\PostAction;
use App\Admin\Actions\PostDownloadAction;

class PostController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\Post';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Post());
        $grid->column('headline', __('Headline'));
        //     $grid->column('tags', __('Tags'));
        $grid->column('media_type')->display(function ($media_type) {
            $media_url = 'https://' . config('filesystems.disks.azure.name') . '.blob.core.windows.net/' . config('filesystems.disks.azure.container') . '/';
            if ($media_type == 'video') {
                return '<video width="178" height="100" controls>
                <source src="' . $media_url . $this->upload_url . '" type="video/mp4">
                Your browser does not support the video tag.
            </video>';
            } else {
                return '<img width="178" src="' . $media_url . $this->upload_url . '" alt="' . $this->headline . '">';
            }
        });
        $grid->column('category.name', __('Category'))->sortable();
        $grid->column('user.name', __('User'))->sortable();
        $grid->published('Published?')->action(PostAction::class)->sortable();
        //  $grid->column('upload_url', 'Download Media')->downloadable();
        //  $grid->upload_url('Download Media')->action(PostDownloadAction::class);
        $grid->column('download_count', __('Download Count'))->sortable();
        $grid->column('created_at', __('Created'))->date('d-m-Y')->sortable();

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Post::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('headline', __('Headline'));
        $show->field('description', __('Description'));
        $show->field('slug', __('Slug'));
        $show->field('tags', __('Tags'));
        $show->field('upload_url', __('Upload url'));
        $show->field('thumb_url', __('Thumb url'));
        $show->field('user_id', __('User id'));
        $show->field('category_id', __('Category id'));
        $show->field('published', __('Published'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Post());

        $form->text('headline', __('Headline'));
        $form->ckeditor('description', __('Description'));
        $form->text('slug', __('Slug'));
        $form->text('tags', __('Tags'));
        $form->text('upload_url', __('Media url'));
        $form->text('thumb_url', __('Thumb url'));
        $form->select('user_id', __('User'))->options(User::all()->pluck('name', 'id'));
        $form->select('category_id', __('Category'))->options(Category::all()->pluck('name', 'id'));
        $form->switch('published', __('Published'));


        return $form;
    }
}
