<?php

namespace Botble\EventsPlaces\Services;

use Botble\EventsPlaces\Models\Post;
use Botble\EventsPlaces\Services\Abstracts\StoreCategoryServiceAbstract;
use Illuminate\Http\Request;

class StoreCategoryService extends StoreCategoryServiceAbstract
{
    public function execute(Request $request, Post $post): void
    {
        $post->categories()->sync($request->input('categories', []));
    }
}
