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


Route::Group(['modules'=>'admin','namespace'=>'Modules\Admin\Controllers'],function(){
    Route::get('callback','PoppingEmailController@callback');
    Route::Group(['prefix'=>'admin'],function(){
        include 'rk_route.php';
        Route::Group(['prefix'=>'imap'],function(){
            Route::get('',[
                #'middleware'=>'acl_access::imap',
                'as'=>'imap',
                'uses'=>'ImapController@index'
            ]);
            Route::post('',[
                #'middleware'=>'acl_access::imap',
                'as'=>'imap',
                'uses'=>'ImapController@store'
            ]);
            Route::get('edit/{id}',[
                #'middleware'=>'acl_access::imap/edit',
                'as'=>'imap.edit',
                'uses'=>'ImapController@edit'
            ]);
            Route::patch('{id}',[
                #'middleware'=>'acl_access::imap/edit',
                'as'=>'imap',
                'uses'=>'ImapController@update'
            ]);
            Route::get('delete/{id}',[
                #'middleware'=>'acl_access::imap/edit',
                'as'=>'imap.delete',
                'uses'=>'ImapController@destroy'
            ]);
        });
        Route::Group(['prefix'=>'smtp'],function(){
            Route::get('',[
                #'middleware'=>'acl_access::smtp',
                'as'=>'',
                'uses'=>'SmtpController@index'
            ]);
            Route::post('',[
                #'middleware'=>'acl_access::smtp',
                'as'=>'',
                'uses'=>'SmtpController@store'
            ]);
            Route::get('edit/{id}',[
                #'middleware'=>'acl_access::smtp/edit',
                'as'=>'smtp.edit',
                'uses'=>'SmtpController@edit'
            ]);
            Route::patch('{id}',[
                #'middleware'=>'acl_access::smtp/edit',
                'as'=>'smtp',
                'uses'=>'SmtpController@update'
            ]);
            Route::get('delete/{id}',[
                #'middleware'=>'acl_access::smtp/edit',
                'as'=>'smtp.delete',
                'uses'=>'SmtpController@destroy'
            ]);
        });
        Route::Group(['prefix'=>'popping-email'],function(){
            Route::get('',[
                #'middleware'=>'acl_access::popping-email',
                'as'=>'',
                'uses'=>'PoppingEmailController@index'
            ]);
            Route::any('search',[
                #'middleware'=>'acl_access::search',
                'as'=>'search',
                'uses'=>'PoppingEmailController@search'
            ]);
            Route::post('',[
                #'middleware'=>'acl_access::popping-email',
                'as'=>'',
                'uses'=>'PoppingEmailController@auth_process'
            ]);
            Route::get('show/{id}',[
                #'middleware'=>'acl_access::popping-email/show',
                'as'=>'popping-email.show',
                'uses'=>'PoppingEmailController@show'
            ]);
            Route::get('edit/{id}',[
                #'middleware'=>'acl_access::popping-email/edit',
                'as'=>'popping-email.edit',
                'uses'=>'PoppingEmailController@edit'
            ]);
            Route::patch('{id}',[
                #'middleware'=>'acl_access::popping-email/edit',
                'as'=>'popping-email',
                'uses'=>'PoppingEmailController@update'
            ]);
            Route::get('delete/{id}',[
                #'middleware'=>'acl_access::popping-email/edit',
                'as'=>'popping-email.delete',
                'uses'=>'PoppingEmailController@destroy'
            ]);
        });
        Route::Group(['prefix'=>'filter'],function(){
            Route::get('',[
                #'middleware'=>'acl_access::filter',
                'as'=>'',
                'uses'=>'FilterController@index'
            ]);
            Route::post('',[
                #'middleware'=>'acl_access::filter',
                'as'=>'',
                'uses'=>'FilterController@store'
            ]);
            Route::get('edit/{id}',[
                #'middleware'=>'acl_access::filter/edit',
                'as'=>'filter.edit',
                'uses'=>'FilterController@edit'
            ]);
            Route::patch('{id}',[
                #'middleware'=>'acl_access::filter/edit',
                'as'=>'filter',
                'uses'=>'FilterController@update'
            ]);
            Route::get('delete/{id}',[
                #'middleware'=>'acl_access::filter/edit',
                'as'=>'filter.delete',
                'uses'=>'FilterController@destroy'
            ]);
        });
        Route::Group(['prefix'=>'schedule'],function(){
            Route::get('',[
                #'middleware'=>'acl_access::schedule',
                'as'=>'',
                'uses'=>'ScheduleController@index'
            ]);
            Route::post('',[
                #'middleware'=>'acl_access::schedule',
                'as'=>'',
                'uses'=>'ScheduleController@store'
            ]);
            Route::get('edit/{id}',[
                #'middleware'=>'acl_access::schedule/edit',
                'as'=>'schedule.edit',
                'uses'=>'ScheduleController@edit'
            ]);
            Route::patch('{id}',[
                #'middleware'=>'acl_access::schedule/edit',
                'as'=>'schedule',
                'uses'=>'ScheduleController@update'
            ]);
            Route::get('delete/{id}',[
                #'middleware'=>'acl_access::schedule/edit',
                'as'=>'schedule.delete',
                'uses'=>'ScheduleController@destroy'
            ]);
        });
        Route::Group(['prefix'=>'invoice'],function(){
            Route::get('',[
                #'middleware'=>'acl_access::invoice',
                'as'=>'',
                'uses'=>'InvoiceController@index'
            ]);
            Route::get('view/{id}',[
                #'middleware'=>'acl_access::invoice/view',
                'as'=>'invoice.view',
                'uses'=>'InvoiceController@show'
            ]);
            Route::get('change_status/{id}',[
                #'middleware'=>'acl_access::invoice/edit',
                'as'=>'invoice.change_status',
                'uses'=>'InvoiceController@edit'
            ]);
            Route::get('delete/{id}',[
                #'middleware'=>'acl_access::invoice/delete',
                'as'=>'invoice.delete',
                'uses'=>'InvoiceController@destroy'
            ]);
            Route::patch('update_status/{id}',[
                #'middleware'=>'acl_access::schedule/edit',
                    'as'=>'update_status',
                    'uses'=>'InvoiceController@update'
            ]);
        });
    });

});
