<?php

namespace App\Admin\Actions;

use App\User;
use Encore\Admin\Actions\RowAction;
use App\Notifications\UserActivation;

class UserActivationAction extends RowAction
{
    public function handle(User $user)
    {
        $user->active = (int) !$user->active;
        $user->save();

        $html = $user->active ? "<i class='fa fa-check text-green'></i>" : "<i class='fa fa-close text-red'></i>";
        $user->notify(new UserActivation($user));

        return $this->response()->html($html);
    }

    public function display($active)
    {
        return $active ? "<i class='fa fa-check text-green'></i>" : "<i class='fa fa-close text-red'></i>";
    }
}
