<?php
/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 6/12/16
 * Time: 10:10 AM
 */

Route::Group(['modules'=>'www', 'namespace'=>'Modules\Www\Controllers'],function(){

    Route::Group(['prefix'=>'dashboard'],function(){
        Route::get('user',[
            #'middleware'=>'acl_access::schedule',
            'route'=>'',
            'uses'=>'UserDashboardController@index'
        ]);

    });

});