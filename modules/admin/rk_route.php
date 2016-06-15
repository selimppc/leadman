<?php

//exit('ok');

Route::any('central-settings', [
    'as' => 'central-settings',
    'uses' => 'CentralSettingsController@index'
]);
Route::any('central-settings-show/{id}', [
    'as' => 'central-settings-show',
    'uses' => 'CentralSettingsController@show'
]);
Route::any('central-settings-edit/{id}', [
    'as' => 'central-settings-edit',
    'uses' => 'CentralSettingsController@edit'
]);