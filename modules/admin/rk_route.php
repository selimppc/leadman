<?php

//exit('ok');

Route::any('central-settings', [
    'as' => 'central-settings',
    'uses' => 'CentralSettingsController@index'
]);