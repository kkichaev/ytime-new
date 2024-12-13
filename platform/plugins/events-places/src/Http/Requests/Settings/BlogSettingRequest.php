<?php

namespace Botble\EventsPlaces\Http\Requests\Settings;

use Botble\Base\Rules\OnOffRule;
use Botble\Support\Http\Requests\Request;
use Illuminate\Validation\Rule;

class BlogSettingRequest extends Request
{
    public function rules(): array
    {
        return [
            'ev_blog_post_schema_enabled' => new OnOffRule(),
            'ev_blog_post_schema_type' => [
                'nullable',
                'string',
                Rule::in(['NewsArticle', 'News', 'Article', 'BlogPosting']),
            ],
        ];
    }
}
