<?php
/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 6/12/16
 * Time: 10:10 AM
 */

Route::Group(['namespace'=>'Modules\User\Controllers'],function(){

    Route::any('user-list', [
        //'middleware' => 'acl_access:user-list',
        'as' => 'user-list',
        'uses' => 'UserController@index'
    ]);

    Route::any('add-user', [
        'middleware' => 'acl_access:add-user',
        'as' => 'add-user',
        'uses' => 'UserController@add_user'
    ]);

    Route::any('search-user', [
        'middleware' => 'acl_access:search-user',
        'as' => 'search-user',
        'uses' => 'UserController@search_user'
    ]);

    Route::any('show-user/{id}', [
        'middleware' => 'acl_access:show-user/{id}',
        'as' => 'show-user',
        'uses' => 'UserController@show_user'
    ]);

    Route::any('edit-user/{id}', [
        'middleware' => 'acl_access:edit-user/{id}',
        'as' => 'edit-user',
        'uses' => 'UserController@edit_user'
    ]);

    Route::any('update-user/{id}', [
        'middleware' => 'acl_access:update-user/{id}',
        'as' => 'update-user',
        'uses' => 'UserController@update_user'
    ]);

    Route::any('delete-user/{id}', [
        'middleware' => 'acl_access:delete-user/{id}',
        'as' => 'delete-user',
        'uses' => 'UserController@destroy_user'
    ]);

});