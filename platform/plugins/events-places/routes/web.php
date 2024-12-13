<?php

use Botble\Base\Facades\AdminHelper;
use Botble\EventsPlaces\Http\Controllers\ExportPostController;
use Botble\EventsPlaces\Http\Controllers\ImportPostController;
use Botble\Theme\Facades\Theme;
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Botble\EventsPlaces\Http\Controllers'], function (): void {
    AdminHelper::registerRoutes(function (): void {
        Route::group(['prefix' => 'events-and-places'], function (): void {
            Route::group(['prefix' => 'ev-posts', 'as' => 'ev-posts.'], function (): void {
                Route::resource('', 'PostController')
                    ->parameters(['' => 'post']);

                Route::get('widgets/recent-posts', [
                    'as' => 'widget.recent-posts',
                    'uses' => 'PostController@getWidgetRecentPosts',
                    'permission' => 'ev-posts.index',
                ]);
            });

            Route::group(['prefix' => 'ev-categories', 'as' => 'ev-categories.'], function (): void {
                Route::resource('', 'CategoryController')
                    ->parameters(['' => 'category']);

                Route::put('update-tree', [
                    'as' => 'update-tree',
                    'uses' => 'CategoryController@updateTree',
                    'permission' => 'ev-categories.index',
                ]);
            });

            Route::group(['prefix' => 'ev-tags', 'as' => 'ev-tags.'], function (): void {
                Route::resource('', 'TagController')
                    ->parameters(['' => 'tag']);

                Route::get('all', [
                    'as' => 'all',
                    'uses' => 'TagController@getAllTags',
                    'permission' => 'ev-tags.index',
                ]);
            });

            Route::prefix('tools/data-synchronize')->name('tools.data-synchronize.')->group(function (): void {
                Route::prefix('export')->name('export.')->group(function (): void {
                    Route::group(['prefix' => 'posts', 'as' => 'posts.', 'permission' => 'ev-posts.export'], function (): void {
                        Route::get('/', [ExportPostController::class, 'index'])->name('index');
                        Route::post('/', [ExportPostController::class, 'store'])->name('store');
                    });
                });

                Route::prefix('import')->name('import.')->group(function (): void {
                    Route::group(['prefix' => 'posts', 'as' => 'posts.', 'permission' => 'ev-posts.import'], function (): void {
                        Route::get('/', [ImportPostController::class, 'index'])->name('index');
                        Route::post('/', [ImportPostController::class, 'import'])->name('store');
                        Route::post('validate', [ImportPostController::class, 'validateData'])->name('validate');
                        Route::post('download-example', [ImportPostController::class, 'downloadExample'])->name('download-example');
                    });
                });
            });
        });

        Route::group(['prefix' => 'settings/events-places', 'as' => 'events-places.settings', 'permission' => 'events-places.settings'], function (): void {
            Route::get('/', [
                'uses' => 'Settings\BlogSettingController@edit',
            ]);

            Route::put('/', [
                'as' => '.update',
                'uses' => 'Settings\BlogSettingController@update',
            ]);
        });
    });

    if (defined('THEME_MODULE_SCREEN_NAME')) {
        Theme::registerRoutes(function (): void {
            Route::get('search', [
                'as' => 'public.search',
                'uses' => 'PublicController@getSearch',
            ]);
        });
    }
});
