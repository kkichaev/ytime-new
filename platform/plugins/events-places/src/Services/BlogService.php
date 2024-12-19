<?php

namespace Botble\EventsPlaces\Services;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Facades\AdminHelper;
use Botble\Base\Supports\Helper;
use Botble\EventsPlaces\Models\Category;
use Botble\EventsPlaces\Models\Post;
use Botble\EventsPlaces\Models\Tag;
use Botble\EventsPlaces\Repositories\Interfaces\PostInterface;
use Botble\Media\Facades\RvMedia;
use Botble\SeoHelper\Facades\SeoHelper;
use Botble\SeoHelper\SeoOpenGraph;
use Botble\Slug\Models\Slug;
use Botble\Theme\Facades\AdminBar;
use Botble\Theme\Facades\Theme;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Arr;

class BlogService
{
    public function handleFrontRoutes(Slug|array $slug): Slug|array|Builder
    {
        if (! $slug instanceof Slug) {
            return $slug;
        }

        $condition = [
            'id' => $slug->reference_id,
            'status' => BaseStatusEnum::PUBLISHED,
        ];

        if (AdminHelper::isPreviewing()) {
            Arr::forget($condition, 'status');
        }

        switch ($slug->reference_type) {
            case Post::class:
                /**
                 * @var Post $post
                 */
                $post = Post::query()
                    ->where($condition)
                    ->with(['categories', 'tags', 'slugable', 'categories.slugable', 'tags.slugable'])
                    ->firstOrFail();

                Helper::handleViewCount($post, 'viewed_post');

                SeoHelper::setTitle($post->name)
                    ->setDescription($post->description);

                $meta = new SeoOpenGraph();
                if ($post->image) {
                    $meta->setImage(RvMedia::getImageUrl($post->image));
                }
                $meta->setDescription($post->description);
                $meta->setUrl($post->url);
                $meta->setTitle($post->name);
                $meta->setType('article');

                SeoHelper::setSeoOpenGraph($meta);

                SeoHelper::meta()->setUrl($post->url);

                if (function_exists('admin_bar')) {
                    AdminBar::registerLink(
                        trans('plugins/events-places::posts.edit_this_post'),
                        route('ev-posts.edit', $post->getKey()),
                        null,
                        'ev-posts.edit'
                    );
                }

                if (function_exists('shortcode')) {
                    shortcode()->getCompiler()->setEditLink(route('ev-posts.edit', $post->id), 'ev-posts.edit');
                }

                $category = $post->categories->sortByDesc('id')->first();
                if ($category) {
                    if ($category->parents->isNotEmpty()) {
                        foreach ($category->parents as $parentCategory) {
                            Theme::breadcrumb()->add($parentCategory->name, $parentCategory->url);
                        }
                    }

                    Theme::breadcrumb()->add($category->name, $category->url);
                }

                Theme::breadcrumb()->add($post->name, $post->url);

                do_action(BASE_ACTION_PUBLIC_RENDER_SINGLE, POST_MODULE_SCREEN_NAME, $post);

                return [
                    'view' => 'post',
                    'default_view' => 'plugins/events-places::themes.post',
                    'data' => compact('post'),
                    'slug' => $post->slug,
                ];
            case Category::class:
                $category = Category::query()
                    ->where($condition)
                    ->with(['slugable'])
                    ->firstOrFail();

                SeoHelper::setTitle($category->name)
                    ->setDescription($category->description);

                $meta = new SeoOpenGraph();
                if ($category->image) {
                    $meta->setImage(RvMedia::getImageUrl($category->image));
                }
                $meta->setDescription($category->description);
                $meta->setUrl($category->url);
                $meta->setTitle($category->name);
                $meta->setType('article');

                SeoHelper::setSeoOpenGraph($meta);

                SeoHelper::meta()->setUrl($category->url);

                if (function_exists('admin_bar')) {
                    AdminBar::registerLink(
                        trans('plugins/events-places::categories.edit_this_category'),
                        route('ev-categories.edit', $category->getKey()),
                        null,
                        'ev-categories.edit'
                    );
                }

                $allRelatedCategoryIds = array_merge([$category->getKey()], $category->activeChildren->pluck('id')->all());

                $posts = app(PostInterface::class)
                    ->getByCategory($allRelatedCategoryIds, (int) theme_option('number_of_posts_in_a_category', 12));

                if ($category->parents->isNotEmpty()) {
                    foreach ($category->parents->reverse() as $parentCategory) {
                        Theme::breadcrumb()->add($parentCategory->name, $parentCategory->url);
                    }
                }

                Theme::breadcrumb()->add($category->name, $category->url);

                do_action(BASE_ACTION_PUBLIC_RENDER_SINGLE, CATEGORY_MODULE_SCREEN_NAME, $category);

                return [
                    'view' => 'category',
                    'default_view' => 'plugins/events-places::themes.category',
                    'data' => compact('category', 'posts'),
                    'slug' => $category->slug,
                ];
            case Tag::class:
                $tag = Tag::query()
                    ->where($condition)
                    ->with(['slugable'])
                    ->firstOrFail();

                SeoHelper::setTitle($tag->name)
                    ->setDescription($tag->description);

                $meta = new SeoOpenGraph();
                $meta->setDescription($tag->description);
                $meta->setUrl($tag->url);
                $meta->setTitle($tag->name);
                $meta->setType('article');

                SeoHelper::setSeoOpenGraph($meta);

                SeoHelper::meta()->setUrl($tag->url);

                if (function_exists('admin_bar')) {
                    AdminBar::registerLink(
                        trans('plugins/events-places::tags.edit_this_tag'),
                        route('ev-tags.edit', $tag->getKey()),
                        null,
                        'ev-tags.edit'
                    );
                }

                $posts = ev_get_posts_by_category($tag->getKey(), (int) theme_option('number_of_posts_in_a_tag', 12));

                Theme::breadcrumb()->add($tag->name, $tag->url);

                do_action(BASE_ACTION_PUBLIC_RENDER_SINGLE, TAG_MODULE_SCREEN_NAME, $tag);

                return [
                    'view' => 'tag',
                    'default_view' => 'plugins/events-places::themes.tag',
                    'data' => compact('tag', 'posts'),
                    'slug' => $tag->slug,
                ];
        }

        return $slug;
    }
}
