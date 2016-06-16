<?php

//exit('ok');

Route::any('admin/central-settings', [
    'middleware'=>'acl_access::admin/central-settings',
    'as' => 'central-settings',
    'uses' => 'CentralSettingsController@index'
]);
Route::any('admin/central-settings-show/{id}', [
    'middleware'=>'acl_access::admin/central-settings-show/{id}',
    'as' => 'central-settings-show',
    'uses' => 'CentralSettingsController@show'
]);
Route::any('admin/central-settings-edit/{id}', [
    'middleware'=>'acl_access::admin/central-settings-edit/{id}',
    'as' => 'central-settings-edit',
    'uses' => 'CentralSettingsController@edit'
]);