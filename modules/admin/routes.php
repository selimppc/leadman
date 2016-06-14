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

    Route::Group(['prefix'=>'imap'],function(){
        Route::get('',[
            #'middleware'=>'acl_access::imap',
            'route'=>'imap',
            'uses'=>'ImapController@index'
        ]);
        Route::post('',[
            #'middleware'=>'acl_access::imap',
            'route'=>'imap',
            'uses'=>'ImapController@store'
        ]);
        Route::get('edit/{id}',[
            #'middleware'=>'acl_access::imap/edit',
            'route'=>'imap.edit',
            'uses'=>'ImapController@edit'
        ]);
        Route::patch('{id}',[
            #'middleware'=>'acl_access::imap/edit',
            'route'=>'imap',
            'uses'=>'ImapController@update'
        ]);
        Route::get('delete/{id}',[
            #'middleware'=>'acl_access::imap/edit',
            'route'=>'imap.delete',
            'uses'=>'ImapController@destroy'
        ]);
    });
    Route::Group(['prefix'=>'smtp'],function(){
        Route::get('',[
            #'middleware'=>'acl_access::smtp',
            'route'=>'',
            'uses'=>'SmtpController@index'
        ]);
        Route::post('',[
            #'middleware'=>'acl_access::smtp',
            'route'=>'',
            'uses'=>'SmtpController@store'
        ]);
        Route::get('edit/{id}',[
            #'middleware'=>'acl_access::smtp/edit',
            'route'=>'smtp.edit',
            'uses'=>'SmtpController@edit'
        ]);
        Route::patch('{id}',[
            #'middleware'=>'acl_access::smtp/edit',
            'route'=>'smtp',
            'uses'=>'SmtpController@update'
        ]);
        Route::get('delete/{id}',[
            #'middleware'=>'acl_access::smtp/edit',
            'route'=>'smtp.delete',
            'uses'=>'SmtpController@destroy'
        ]);
    });

});
