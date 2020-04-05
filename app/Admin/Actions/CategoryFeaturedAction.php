<?php

namespace App\Admin\Actions;

use App\Category;
use Encore\Admin\Actions\RowAction;

class CategoryFeaturedAction extends RowAction
{
    // After the page clicks on the chart in this column, send the request to the backend handle method to execute
    public function handle(Category $category)
    {
        $category->featured = (int) !$category->featured;
        $category->save();

        $html = $category->featured ? "<i class='fa fa-check text-green'></i>" : "<i class='fa fa-close text-red'></i>";

        return $this->response()->html($html);
    }

    // This method displays different icons in this column based on the value of the `star` field.
    public function display($featured)
    {
        return $featured ? "<i class='fa fa-check text-green'></i>" : "<i class='fa fa-close text-red'></i>";
    }
}
