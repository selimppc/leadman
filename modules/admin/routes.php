<?php
/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 6/12/16
 * Time: 10:10 AM
 */
Route::get('/', function () {
    return view('admin::layouts.master');
});
Route::Group(['modules'=>'admin','prefix'=>'admin','namespace'=>'Modules\Admin\Controllers'],function(){

    Route::get('imap',[
        #'middleware'=>'acl_access::imap',
        'route'=>'imap',
        'uses'=>'ImapController@index'
    ]);
    Route::post('imap',[
        #'middleware'=>'acl_access::imap',
        'route'=>'imap',
        'uses'=>'ImapController@store'
    ]);

});
