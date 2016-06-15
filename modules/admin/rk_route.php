<?php

//exit('ok');

Route::any('central-settings', [
    'middleware'=>'acl_access::central-settings',
    'as' => 'central-settings',
    'uses' => 'CentralSettingsController@index'
]);
Route::any('central-settings-show/{id}', [
    'middleware'=>'acl_access::central-settings-show/{id}',
    'as' => 'central-settings-show',
    'uses' => 'CentralSettingsController@show'
]);
Route::any('central-settings-edit/{id}', [
    'middleware'=>'acl_access::central-settings-edit/{id}',
    'as' => 'central-settings-edit',
    'uses' => 'CentralSettingsController@edit'
]);