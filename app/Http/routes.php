<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['middleware' => ['web']], function () {
    Route::get('/', 'AngularController@serveApp');
    Route::get('/admin', 'AdminAngularController@serveApp');
    Route::get('/unsupported-browser', 'AngularController@unsupported');
    Route::get('user/verify/{verificationCode}', ['uses' => 'Auth\AuthController@verifyUserEmail']);
    Route::get('auth/{provider}', ['uses' => 'Auth\AuthController@redirectToProvider']);
    Route::get('auth/{provider}/callback', ['uses' => 'Auth\AuthController@handleProviderCallback']);
    Route::get('/api/authenticate/user', 'Auth\AuthController@getAuthenticatedUser');
});

$api->group(['middleware' => ['api']], function ($api) {
    $api->controller('auth', 'Auth\AuthController');

    // Password Reset Routes...
    $api->post('auth/password/email', 'Auth\PasswordResetController@sendResetLinkEmail');
    $api->get('auth/password/verify', 'Auth\PasswordResetController@verify');
    $api->post('auth/password/reset', 'Auth\PasswordResetController@reset');
    
    $api->get('assets/', 'AssetsController@getAssetsIndex');
    $api->get('assets/{id}', 'AssetsController@getAssetsShow')->where('id', '[0-9]+');
    
    $api->get('categories/', 'CategoriesController@getCategoriesIndex');
    $api->get('categories/{id}', 'CategoriesController@getCategoriesShow')->where('id', '[0-9]+');

    $api->get('profile/', 'ProfileController@getProfileShow');
    $api->get('profile/{id}', 'ProfileController@getProfileShow')->where('id', '[0-9]+');
});

$api->group(['middleware' => ['api', 'api.auth']], function ($api) {
    $api->get('users/me', 'UserController@getMe');
    $api->put('users/me', 'UserController@putMe');
});

$api->group(['middleware' => ['api', 'api.auth', 'role:admin.super|admin.user']], function ($api) {
    $api->controller('users', 'UserController');

    $api->get('assets/upload', 'AssetsController@postAssets');
    $api->post('assets/upload', 'AssetsController@postAssets');

    $api->get('categories/upload/{id}', 'CategoriesController@postIcon')->where('id', '[0-9]+');
    $api->post('categories/upload/{id}', 'CategoriesController@postIcon')->where('id', '[0-9]+');

    $api->get('profile/upload', 'ProfileController@postIcon')->where('id', '[0-9]+');
    $api->post('profile/upload', 'ProfileController@postIcon')->where('id', '[0-9]+');
    
    $api->post('assets', 'AssetsController@postAssets');
    $api->put('assets/{id}', 'AssetsController@putAssetsShow')->where('id', '[0-9]+');
    $api->delete('assets/{id}', 'AssetsController@deleteAssets')->where('id', '[0-9]+');

    $api->post('categories', 'CategoriesController@postCategories');
    $api->put('categories/{id}', 'CategoriesController@putCategoriesShow')->where('id', '[0-9]+');
    $api->delete('categories/{id}', 'CategoriesController@deleteCategories')->where('id', '[0-9]+');

    $api->put('profile/{id}', 'ProfileController@putProfileShow')->where('id', '[0-9]+');
});
