<?php

namespace Botble\EventsPlaces\Services;

use Botble\ACL\Models\User;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\EventsPlaces\Forms\TagForm;
use Botble\EventsPlaces\Models\Post;
use Botble\EventsPlaces\Models\Tag;
use Botble\EventsPlaces\Services\Abstracts\StoreTagServiceAbstract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoreTagService extends StoreTagServiceAbstract
{
    public function execute(Request $request, Post $post): void
    {
        $tagsInput = $request->input('tag');

        if (! $tagsInput) {
            $tagsInput = [];
        } else {
            $tagsInput = is_array($tagsInput) ? $tagsInput : collect(json_decode($tagsInput, true))->pluck('value')->all();
        }

        $tags = $post->tags->pluck('name')->all();

        if (count($tags) != count($tagsInput) || count(array_diff($tags, $tagsInput)) > 0) {
            $post->tags()->detach();
            foreach ($tagsInput as $tagName) {
                if (! trim($tagName)) {
                    continue;
                }

                $tag = Tag::query()->where('name', $tagName)->first();

                if ($tag === null && ! empty($tagName)) {
                    $form = TagForm::create();

                    $form
                        ->saving(function (TagForm $form) use ($tagName): void {
                            $form
                                ->getModel()
                                ->fill([
                                    'name' => $tagName,
                                    'author_id' => Auth::guard()->check() ? Auth::guard()->id() : 0,
                                    'author_type' => User::class,
                                    'status' => BaseStatusEnum::PUBLISHED,
                                ])
                                ->save();

                            $form->setRequest($form->getRequest()->merge(['slug' => $tagName]));
                        });

                    $tag = $form->getModel();
                }

                if (! empty($tag)) {
                    $post->tags()->attach($tag->id);
                }
            }
        }
    }
}
