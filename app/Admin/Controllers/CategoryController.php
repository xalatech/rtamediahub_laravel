<?php

namespace App\Admin\Controllers;

use App\Category;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

use App\Admin\Actions\CategoryPublishAction;
use App\Admin\Actions\CategoryFeaturedAction;

class CategoryController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\Category';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Category());

        $grid->column('name', __('Name'));
        $grid->column('description', __('Description'));
        $grid->column('icon', __('Icon'));
        $grid->column('sort_order', __('Sort order'))->sortable();
        $grid->column('url', __('Url'));
        $grid->published('Published?')->action(CategoryPublishAction::class)->sortable();
        $grid->featured('Featured?')->action(CategoryFeaturedAction::class)->sortable();
        $grid->column('created_at', __('Created on'))->date('d-m-Y')->sortable();
        $grid->column('updated_at', __('Updated on'))->date('d-m-Y')->sortable();

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
        $show = new Show(Category::findOrFail($id));

        $show->field('name', __('Name'));
        $show->field('description', __('Description'));
        $show->field('icon', __('Icon'));
        $show->field('sort_order', __('Sort order'));
        $show->field('url', __('Url'));
        $show->field('published', __('Published'));
        $show->field('featured', __('Featured'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Category());

        $form->text('name', __('Name'));
        $form->textarea('description', __('Description'));
        $form->text('icon', __('Icon'));
        $form->number('sort_order', __('Sort order'));
        $form->url('url', __('Url'));
        $form->switch('published', __('Published'));

        return $form;
    }
}
