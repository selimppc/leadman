<?php
/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 6/12/16
 * Time: 10:10 AM
 */

Route::Group(['modules'=>'www', 'namespace'=>'Modules\Www\Controllers'],function(){

    Route::get('dashboard/user',[
        'middleware'=>'acl_access::dashboard/user',
        'route'=>'dashboard.user',
        'uses'=>'UserDashboardController@index'
    ]);


});