<?php
/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 6/12/16
 * Time: 10:10 AM
 */
/*Route::get('/', function () {
    return view('admin::layouts.master');
});*/


Route::get('',[
    #'middleware'=>'acl_access::imap',
    'route'=>'imap',
    'uses'=>'ImapController@index'
]);