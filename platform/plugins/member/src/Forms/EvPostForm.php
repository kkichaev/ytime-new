<?php

namespace Botble\Member\Forms;

use Botble\Base\Forms\FieldOptions\TagFieldOption;
use Botble\Base\Forms\FieldOptions\TextareaFieldOption;
use Botble\Base\Forms\Fields\TagField;
use Botble\EventsPlaces\Forms\PostForm as BasePostForm;
use Botble\EventsPlaces\Models\Post;
use Botble\EventsPlaces\Models\Tag;
use Botble\Member\Forms\Fields\CustomEditorField;
use Botble\Member\Http\Requests\PostRequest;

class EvPostForm extends BasePostForm
{
    public function setup(): void
    {
        parent::setup();

        $this
            ->model(Post::class)
            ->setFormOption('template', 'plugins/member::forms.base')
            ->hasFiles()
            ->setValidatorClass(PostRequest::class)
            ->setBreakFieldPoint('categories[]')
            ->remove('status')
            ->remove('is_featured')
            ->remove('content')
            ->addAfter(
                'description',
                'content',
                CustomEditorField::class,
                TextareaFieldOption::make()->label(trans('core/base::forms.content'))->rows(4)
            )
            ->modify(
                'tag',
                TagField::class,
                TagFieldOption::make()
                    ->label(trans('plugins/events-places::posts.form.tags'))
                    ->when($this->getModel()->getKey(), function (TagFieldOption $fieldOption) {
                        /**
                         * @var Post $post
                         */
                        $post = $this->getModel();

                        return $fieldOption
                            ->value(
                                $post->tags()
                                    ->select('name')
                                    ->get()
                                    ->map(fn (Tag $item) => $item->name)
                                    ->implode(',')
                            );
                    })
                    ->placeholder(trans('plugins/events-places::base.write_some_tags'))
                    ->ajaxUrl(route('public.member.tags.all')),
                true
            );
    }
}
