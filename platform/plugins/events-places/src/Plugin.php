<?php

namespace Botble\EventsPlaces;

use Botble\EventsPlaces\Models\Category;
use Botble\EventsPlaces\Models\Tag;
use Botble\Dashboard\Models\DashboardWidget;
use Botble\Menu\Models\MenuNode;
use Botble\PluginManagement\Abstracts\PluginOperationAbstract;
use Botble\Setting\Facades\Setting;
use Botble\Widget\Models\Widget;
use Illuminate\Support\Facades\Schema;

class Plugin extends PluginOperationAbstract
{
    public static function remove(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('ev_post_tags');
        Schema::dropIfExists('ev_post_categories');
        Schema::dropIfExists('ev_posts');
        Schema::dropIfExists('ev_categories');
        Schema::dropIfExists('ev_tags');
        Schema::dropIfExists('ev_posts_translations');
        Schema::dropIfExists('ev_categories_translations');
        Schema::dropIfExists('ev_tags_translations');

        Widget::query()
            ->where('widget_id', 'widget_posts_recent')
            ->each(fn (DashboardWidget $dashboardWidget) => $dashboardWidget->delete());

        MenuNode::query()
            ->whereIn('reference_type', [Category::class, Tag::class])
            ->each(fn (MenuNode $menuNode) => $menuNode->delete());

        Setting::delete([
            'ev_ev_blog_post_schema_enabled',
            'ev_blog_post_schema_type',
        ]);
    }
}
