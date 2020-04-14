<?php

namespace App\Admin\Actions;

use App\User;
use Encore\Admin\Actions\RowAction;

class UserAction extends RowAction
{
    public function handle(User $user)
    {
        $user->notifications = (int) !$user->notifications;
        $user->save();

        $html = $user->notifications ? "<i class='fa fa-check text-green'></i>" : "<i class='fa fa-close text-red'></i>";

        return $this->response()->html($html);
    }

    public function display($notify)
    {
        return $notify ? "<i class='fa fa-check text-green'></i>" : "<i class='fa fa-close text-red'></i>";
    }
}
