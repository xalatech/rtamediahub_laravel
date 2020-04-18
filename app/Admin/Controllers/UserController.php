<?php

namespace App\Admin\Controllers;

use App\User;
use App\Role;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Admin\Actions\UserAction;
use App\Admin\Actions\UserActivationAction;

class UserController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\User';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new User());

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('email', __('Email'));
        $grid->active('Activate?')->action(UserActivationAction::class)->sortable();
        $grid->notifications('Notifications?')->action(UserAction::class)->sortable();
        $grid->roles()->display(function ($roles) {

            $roles = array_map(function ($role) {
                return "<span class='label label-success'>{$role['name']}</span>";
            }, $roles);

            return join('&nbsp;', $roles);
        });
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
        $show = new Show(User::findOrFail($id));

        $show->field('name', __('Name'));
        $show->field('email', __('Email'));
        $show->field('email_verified_at', __('Email verified at'));
        $show->field('password', __('Password'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new User());
        $form->text('name', __('Name'));
        $form->email('email', __('Email'));
        $form->datetime('email_verified_at', __('Email verified at'))->default(date('Y-m-d'));
        $form->password(Hash::make('password'), __('Password'));
        $form->text('remember_token', __('Remember token'));
        $form->multipleSelect('roles')->options(Role::all()->pluck('name', 'id'));


        return $form;
    }

    public function users(Request $request)
    {
        $q = $request->get('q');
        return User::where('name', 'like', "%$q%")->paginate(null, ['id', 'name as text']);
    }
}
