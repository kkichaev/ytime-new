<?php

namespace Botble\EventsPlaces\Services\Abstracts;

use Botble\EventsPlaces\Models\Post;
use Illuminate\Http\Request;

abstract class StoreTagServiceAbstract
{
    abstract public function execute(Request $request, Post $post): void;
}
