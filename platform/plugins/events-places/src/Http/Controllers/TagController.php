<?php

namespace Botble\EventsPlaces\Http\Controllers;

use Botble\ACL\Models\User;
use Botble\Base\Http\Actions\DeleteResourceAction;
use Botble\Base\Http\Controllers\BaseController;
use Botble\Base\Supports\Breadcrumb;
use Botble\EventsPlaces\Forms\TagForm;
use Botble\EventsPlaces\Http\Requests\TagRequest;
use Botble\EventsPlaces\Models\Tag;
use Botble\EventsPlaces\Tables\TagTable;
use Illuminate\Support\Facades\Auth;

class TagController extends BaseController
{
    protected function breadcrumb(): Breadcrumb
    {
        return parent::breadcrumb()
            ->add(trans('plugins/events-places::base.menu_name'))
            ->add(trans('plugins/events-places::tags.menu'), route('ev-tags.index'));
    }

    public function index(TagTable $dataTable)
    {
        $this->pageTitle(trans('plugins/events-places::tags.menu'));

        return $dataTable->renderTable();
    }

    public function create()
    {
        $this->pageTitle(trans('plugins/events-places::ev-tags.create'));

        return TagForm::create()->renderForm();
    }

    public function store(TagRequest $request)
    {
        $form = TagForm::create();

        $form
            ->saving(function (TagForm $form) use ($request): void {
                $form
                    ->getModel()
                    ->fill([...$request->validated(),
                        'author_id' => Auth::guard()->id(),
                        'author_type' => User::class,
                    ])
                    ->save();
            });

        return $this
            ->httpResponse()
            ->setPreviousRoute('ev-tags.index')
            ->setNextRoute('ev-tags.edit', $form->getModel()->getKey())
            ->withCreatedSuccessMessage();
    }

    public function edit(Tag $tag)
    {
        $this->pageTitle(trans('core/base::forms.edit_item', ['name' => $tag->name]));

        return TagForm::createFromModel($tag)->renderForm();
    }

    public function update(Tag $tag, TagRequest $request)
    {
        TagForm::createFromModel($tag)->setRequest($request)->save();

        return $this
            ->httpResponse()
            ->setPreviousRoute('ev-tags.index')
            ->withUpdatedSuccessMessage();
    }

    public function destroy(Tag $tag)
    {
        return DeleteResourceAction::make($tag);
    }

    public function getAllTags()
    {
        return Tag::query()->pluck('name')->all();
    }
}
