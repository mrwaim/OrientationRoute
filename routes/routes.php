<?php

Route::group(['prefix' => 'videos'], function () {
    Route::group(['middleware' => ['auth']], function () {
        Route::get('all', '\Klsandbox\OrientationRoute\Http\Controllers\VideoController@index');
        Route::get('users', '\Klsandbox\OrientationRoute\Http\Controllers\VideoController@users');
        Route::get('users/{user}/view', '\Klsandbox\OrientationRoute\Http\Controllers\VideoController@viewUser');

        Route::get('{video}/view', '\Klsandbox\OrientationRoute\Http\Controllers\VideoController@video');
        Route::get('{video}/watch', '\Klsandbox\OrientationRoute\Http\Controllers\VideoController@watchVideo');
        Route::get('{video}/unwatch', '\Klsandbox\OrientationRoute\Http\Controllers\VideoController@unwatchVideo');
    });

    Route::group(['middleware' => ['role:admin']], function () {
        Route::get('all-videos', '\Klsandbox\OrientationRoute\Http\Controllers\VideoController@allVideos');
        Route::get('create-video', '\Klsandbox\OrientationRoute\Http\Controllers\VideoController@create');
        Route::post('store', '\Klsandbox\OrientationRoute\Http\Controllers\VideoController@store');

        Route::get('{video}/edit', '\Klsandbox\OrientationRoute\Http\Controllers\VideoController@edit');
        Route::get('{video}/delete', '\Klsandbox\OrientationRoute\Http\Controllers\VideoController@delete');
        Route::post('{video}/update', '\Klsandbox\OrientationRoute\Http\Controllers\VideoController@update');
        Route::post('update-order', '\Klsandbox\OrientationRoute\Http\Controllers\VideoController@updateOrder');
    });
});

Route::bind('video', function ($slug) {
    $slug = explode('-', $slug);
    $order = $slug[0];

    $video = \Klsandbox\OrientationRoute\Models\Video::forSite()->whereOrderNumber($order)->first();
    \Klsandbox\SiteModel\Site::protect($video, 'Video');

    return $video;
});
