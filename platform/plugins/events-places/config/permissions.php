<?php

return [
    [
        'name' => 'Blog',
        'flag' => 'plugins.events-places',
        'parent_flag' => 'core.cms',
    ],
    [
        'name' => 'Posts',
        'flag' => 'ev-posts.index',
        'parent_flag' => 'plugins.events-places',
    ],
    [
        'name' => 'Create',
        'flag' => 'ev-posts.create',
        'parent_flag' => 'ev-posts.index',
    ],
    [
        'name' => 'Edit',
        'flag' => 'ev-posts.edit',
        'parent_flag' => 'ev-posts.index',
    ],
    [
        'name' => 'Delete',
        'flag' => 'ev-posts.destroy',
        'parent_flag' => 'ev-posts.index',
    ],

    [
        'name' => 'Categories',
        'flag' => 'ev-categories.index',
        'parent_flag' => 'plugins.events-places',
    ],
    [
        'name' => 'Create',
        'flag' => 'ev-categories.create',
        'parent_flag' => 'ev-categories.index',
    ],
    [
        'name' => 'Edit',
        'flag' => 'ev-categories.edit',
        'parent_flag' => 'ev-categories.index',
    ],
    [
        'name' => 'Delete',
        'flag' => 'ev-categories.destroy',
        'parent_flag' => 'ev-categories.index',
    ],

    [
        'name' => 'Tags',
        'flag' => 'ev-tags.index',
        'parent_flag' => 'plugins.events-places',
    ],
    [
        'name' => 'Create',
        'flag' => 'ev-tags.create',
        'parent_flag' => 'ev-tags.index',
    ],
    [
        'name' => 'Edit',
        'flag' => 'ev-tags.edit',
        'parent_flag' => 'ev-tags.index',
    ],
    [
        'name' => 'Delete',
        'flag' => 'ev-tags.destroy',
        'parent_flag' => 'ev-tags.index',
    ],
    [
        'name' => 'EventPlaces',
        'flag' => 'events-places.settings',
        'parent_flag' => 'settings.others',
    ],
    [
        'name' => 'Export Posts',
        'flag' => 'ev-posts.export',
        'parent_flag' => 'tools.data-synchronize',
    ],
    [
        'name' => 'Import Posts',
        'flag' => 'ev-posts.import',
        'parent_flag' => 'tools.data-synchronize',
    ],
];
