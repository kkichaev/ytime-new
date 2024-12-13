<?php

namespace Botble\EventsPlaces\Forms\Settings;

use Botble\Base\Forms\FieldOptions\OnOffFieldOption;
use Botble\Base\Forms\FieldOptions\SelectFieldOption;
use Botble\Base\Forms\Fields\OnOffCheckboxField;
use Botble\Base\Forms\Fields\SelectField;
use Botble\EventsPlaces\Http\Requests\Settings\BlogSettingRequest;
use Botble\Setting\Forms\SettingForm;

class BlogSettingForm extends SettingForm
{
    public function setup(): void
    {
        parent::setup();

        $this
            ->setSectionTitle(trans('plugins/events-places::base.settings.title'))
            ->setSectionDescription(trans('plugins/events-places::base.settings.description'))
            ->setValidatorClass(BlogSettingRequest::class)
            ->add(
                'ev_blog_post_schema_enabled',
                OnOffCheckboxField::class,
                OnOffFieldOption::make()
                ->label(trans('plugins/events-places::base.settings.enable_blog_post_schema'))
                ->defaultValue($targetValue = ((bool) setting('ev_blog_post_schema_enabled', true)))
                ->helperText(trans('plugins/events-places::base.settings.enable_blog_post_schema_description'))
            )
            ->addOpenCollapsible('ev_blog_post_schema_enabled', '1', $targetValue)
            ->add(
                'ev_blog_post_schema_type',
                SelectField::class,
                SelectFieldOption::make()
                    ->label(trans('plugins/events-places::base.settings.schema_type'))
                    ->choices([
                        'NewsArticle' => 'NewsArticle',
                        'News' => 'News',
                        'Article' => 'Article',
                        'BlogPosting' => 'BlogPosting',
                    ])
                    ->selected(setting('ev_blog_post_schema_type', 'NewsArticle'))
            )
            ->addCloseCollapsible('ev_blog_post_schema_enabled', '1');
    }
}
