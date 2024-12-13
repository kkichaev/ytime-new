<?php

namespace Botble\EventsPlaces\Http\Controllers\Settings;

use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\EventsPlaces\Forms\Settings\BlogSettingForm;
use Botble\EventsPlaces\Http\Requests\Settings\BlogSettingRequest;
use Botble\Setting\Http\Controllers\SettingController;

class BlogSettingController extends SettingController
{
    public function edit()
    {
        $this->pageTitle(trans('plugins/events-places::base.settings.title'));

        return BlogSettingForm::create()->renderForm();
    }

    public function update(BlogSettingRequest $request): BaseHttpResponse
    {
        return $this->performUpdate($request->validated());
    }
}
