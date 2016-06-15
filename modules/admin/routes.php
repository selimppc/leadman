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

include 'rk_route.php';

Route::Group(['modules'=>'admin','namespace'=>'Modules\Admin\Controllers'],function(){
    Route::get('callback','PoppingEmailController@callback');
    Route::Group(['prefix'=>'admin'],function(){
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
        Route::Group(['prefix'=>'popping-email'],function(){
            Route::get('',[
                #'middleware'=>'acl_access::popping-email',
                'route'=>'',
                'uses'=>'PoppingEmailController@index'
            ]);
            Route::any('search',[
                #'middleware'=>'acl_access::search',
                'route'=>'search',
                'uses'=>'PoppingEmailController@search'
            ]);
            Route::post('',[
                #'middleware'=>'acl_access::popping-email',
                'route'=>'',
                'uses'=>'PoppingEmailController@auth_process'
            ]);
            Route::get('show/{id}',[
                #'middleware'=>'acl_access::popping-email/show',
                'route'=>'popping-email.show',
                'uses'=>'PoppingEmailController@show'
            ]);
            Route::get('edit/{id}',[
                #'middleware'=>'acl_access::popping-email/edit',
                'route'=>'popping-email.edit',
                'uses'=>'PoppingEmailController@edit'
            ]);
            Route::patch('{id}',[
                #'middleware'=>'acl_access::popping-email/edit',
                'route'=>'popping-email',
                'uses'=>'PoppingEmailController@update'
            ]);
            Route::get('delete/{id}',[
                #'middleware'=>'acl_access::popping-email/edit',
                'route'=>'popping-email.delete',
                'uses'=>'PoppingEmailController@destroy'
            ]);
        });
        Route::Group(['prefix'=>'filter'],function(){
            Route::get('',[
                #'middleware'=>'acl_access::filter',
                'route'=>'',
                'uses'=>'FilterController@index'
            ]);
            Route::post('',[
                #'middleware'=>'acl_access::filter',
                'route'=>'',
                'uses'=>'FilterController@store'
            ]);
            Route::get('edit/{id}',[
                #'middleware'=>'acl_access::filter/edit',
                'route'=>'filter.edit',
                'uses'=>'FilterController@edit'
            ]);
            Route::patch('{id}',[
                #'middleware'=>'acl_access::filter/edit',
                'route'=>'filter',
                'uses'=>'FilterController@update'
            ]);
            Route::get('delete/{id}',[
                #'middleware'=>'acl_access::filter/edit',
                'route'=>'filter.delete',
                'uses'=>'FilterController@destroy'
            ]);
        });
        Route::Group(['prefix'=>'schedule'],function(){
            Route::get('',[
                #'middleware'=>'acl_access::schedule',
                'route'=>'',
                'uses'=>'ScheduleController@index'
            ]);
            Route::post('',[
                #'middleware'=>'acl_access::schedule',
                'route'=>'',
                'uses'=>'ScheduleController@store'
            ]);
            Route::get('edit/{id}',[
                #'middleware'=>'acl_access::schedule/edit',
                'route'=>'schedule.edit',
                'uses'=>'ScheduleController@edit'
            ]);
            Route::patch('{id}',[
                #'middleware'=>'acl_access::schedule/edit',
                'route'=>'schedule',
                'uses'=>'ScheduleController@update'
            ]);
            Route::get('delete/{id}',[
                #'middleware'=>'acl_access::schedule/edit',
                'route'=>'schedule.delete',
                'uses'=>'ScheduleController@destroy'
            ]);
        });
        Route::Group(['prefix'=>'invoice'],function(){
            Route::get('',[
                #'middleware'=>'acl_access::invoice',
                'route'=>'',
                'uses'=>'InvoiceController@index'
            ]);
            Route::get('view/{id}',[
                #'middleware'=>'acl_access::invoice/edit',
                'route'=>'invoice.view',
                'uses'=>'InvoiceController@show'
            ]);
            Route::get('delete/{id}',[
                #'middleware'=>'acl_access::invoice/edit',
                'route'=>'invoice.delete',
                'uses'=>'InvoiceController@destroy'
            ]);
        });
    });

});
