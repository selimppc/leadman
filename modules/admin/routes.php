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


Route::Group(['modules'=>'admin','namespace'=>'Modules\Admin\Controllers','middleware'=>'auth'],function(){


    Route::any('admin/central-settings', [
        'middleware'=>'acl_access::admin/central-settings',
        'as' => 'central-settings',
        'uses' => 'CentralSettingsController@index'
    ]);
    Route::any('admin/central-settings-show/{id}', [
        'middleware'=>'acl_access::admin/central-settings-show/{id}',
        'as' => 'central-settings-show',
        'uses' => 'CentralSettingsController@show'
    ]);
    Route::any('admin/central-settings-edit/{id}', [
        'middleware'=>'acl_access::admin/central-settings-edit/{id}',
        'as' => 'central-settings-edit',
        'uses' => 'CentralSettingsController@edit'
    ]);

    Route::any('admin/central-settings-update/{id}', [
        'middleware'=>'acl_access::admin/central-settings-update/{id}',
        'as' => 'central-settings-update',
        'uses' => 'CentralSettingsController@update'
    ]);

    /*Route::any('/', [
        'as' => 'dashboard',
        'uses' => 'DashboardController@dashboard'
    ]);

    Route::any('dashboard', [
        'as' => 'dashboard',
        'uses' => 'DashboardController@dashboard'
    ]);*/

    Route::get('/',[
            'middleware'=>'acl_access::/',
            'as'=>'/',
            'uses'=>'DashboardController@dashboard'
    ]);

    Route::get('dashboard',[
            'middleware'=>'acl_access::dashboard',
            'as'=>'dashboard',
            'uses'=>'DashboardController@dashboard'
    ]);

    Route::any('all_routes_uri', [
        'as' => 'all_routes_uri',
        'uses' => 'DashboardController@all_routes_uri'
    ]);

    Route::any('user-by-lead/{user_id}', [
        'as' => 'user-by-lead',
        'uses' => 'DashboardController@user_by_lead'
    ]);


    Route::any('callback',[
        #'middleware'=>'acl_access::callback',
        'as'=>'callback',
        'uses'=>'PoppingEmailController@callback'
    ]);


    Route::get('admin/imap',[
        'middleware'=>'acl_access::admin/imap',
        'as'=>'admin.imap',
        'uses'=>'ImapController@index'
    ]);
    Route::post('admin/imap_store',[
        'middleware'=>'acl_access::admin/imap_store',
        'as'=>'admin.imap_store',
        'uses'=>'ImapController@store'
    ]);
    Route::get('admin/imap/edit/{id}',[
        'middleware'=>'acl_access::admin/imap/edit/{id}',
        'as'=>'admin.imap.edit',
        'uses'=>'ImapController@edit'
    ]);
    Route::patch('admin/imap/{id}',[
        'middleware'=>'acl_access::admin/imap/{id}',
        'as'=>'admin.imap',
        'uses'=>'ImapController@update'
    ]);
    Route::get('admin/imap/delete/{id}',[
        'middleware'=>'acl_access::admin/imap/delete/{id}',
        'as'=>'admin.imap.delete',
        'uses'=>'ImapController@destroy'
    ]);
    Route::get('admin/smtp',[
        'middleware'=>'acl_access::admin/smtp',
        'as'=>'admin.smtp',
        'uses'=>'SmtpController@index'
    ]);
    Route::post('admin/smtp_store',[
        'middleware'=>'acl_access::admin/smtp_store',
        'as'=>'admin.smtp_store',
        'uses'=>'SmtpController@store'
    ]);
    Route::get('admin/smtp/edit/{id}',[
        'middleware'=>'acl_access::admin/smtp/edit/{id}',
        'as'=>'admin.smtp.edit',
        'uses'=>'SmtpController@edit'
    ]);
    Route::patch('admin/smtp/{id}',[
        'middleware'=>'acl_access::admin/smtp/{id}',
        'as'=>'admin.smtp',
        'uses'=>'SmtpController@update'
    ]);
    Route::get('admin/smtp/delete/{id}',[
        'middleware'=>'acl_access::admin/smtp/delete/{id}',
        'as'=>'admin.smtp.delete',
        'uses'=>'SmtpController@destroy'
    ]);
    Route::get('admin/popping-email',[
        'middleware'=>'acl_access::admin/popping-email',
        'as'=>'admin.popping-email',
        'uses'=>'PoppingEmailController@index'
    ]);
    Route::any('admin/popping-email/search',[
        'middleware'=>'acl_access::search',
        'as'=>'admin.popping-email.search',
        'uses'=>'PoppingEmailController@search'
    ]);
    Route::post('admin/popping-email-store',[
        'middleware'=>'acl_access::admin/popping-email-store',
        'as'=>'admin.popping-email-store',
        'uses'=>'PoppingEmailController@auth_process'
    ]);
    Route::get('admin/popping-email/show/{id}',[
        'middleware'=>'acl_access::admin/popping-email/show/{id}',
        'as'=>'admin.popping-email.show',
        'uses'=>'PoppingEmailController@show'
    ]);

    Route::get('admin/popping-email/active-inactive/{id}',[
        'middleware'=>'acl_access::admin/popping-email/active-inactive/{id}',
        'as'=>'admin.popping-email.active-inactive',
        'uses'=>'PoppingEmailController@active_inactive'
    ]);

    Route::get('admin/popping-email/edit/{id}',[
        'middleware'=>'acl_access::admin/popping-email/edit/{id}',
        'as'=>'admin.popping-email.edit',
        'uses'=>'PoppingEmailController@edit'
    ]);
    Route::patch('admin/popping-email/{id}',[
        'middleware'=>'acl_access::admin/popping-email/{id}',
        'as'=>'admin.popping-email',
        'uses'=>'PoppingEmailController@update'
    ]);
    Route::get('admin/popping-email/delete/{id}',[
        'middleware'=>'acl_access::admin/popping-email/delete/{id}',
        'as'=>'admin.popping-email.delete',
        'uses'=>'PoppingEmailController@destroy'
    ]);
    Route::get('admin/filter',[
        'middleware'=>'acl_access::admin/filter',
        'as'=>'admin.filter',
        'uses'=>'FilterController@index'
    ]);
    Route::post('admin/filter_store',[
        'middleware'=>'acl_access::admin/filter_store',
        'as'=>'admin.filter_store',
        'uses'=>'FilterController@store'
    ]);
    Route::get('admin/filter/edit/{id}',[
        'middleware'=>'acl_access::admin/filter/edit/{id}',
        'as'=>'filter.edit',
        'uses'=>'FilterController@edit'
    ]);
    Route::patch('admin/filter/{id}',[
        'middleware'=>'acl_access::admin/filter/{id}',
        'as'=>'admin.filter',
        'uses'=>'FilterController@update'
    ]);
    Route::get('admin/filter/delete/{id}',[
        'middleware'=>'acl_access::admin/filter/delete/{id}',
        'as'=>'admin.filter.delete',
        'uses'=>'FilterController@destroy'
    ]);
    Route::get('admin/schedule',[
        'middleware'=>'acl_access::admin/schedule',
        'as'=>'admin.schedule',
        'uses'=>'ScheduleController@index'
    ]);
    Route::post('admin/schedule_store',[
        'middleware'=>'acl_access::admin/schedule_store',
        'as'=>'admin.schedule_store',
        'uses'=>'ScheduleController@store'
    ]);
    Route::get('admin/schedule/edit/{id}',[
        'middleware'=>'acl_access::admin/schedule/edit/{id}',
        'as'=>'admin.schedule.edit',
        'uses'=>'ScheduleController@edit'
    ]);
    Route::patch('admin/schedule/{id}',[
        'middleware'=>'acl_access::admin/schedule/{id}',
        'as'=>'schedule',
        'uses'=>'ScheduleController@update'
    ]);
    Route::get('admin/schedule/delete/{id}',[
        'middleware'=>'acl_access::admin/schedule/delete/{id}',
        'as'=>'admin.schedule.delete',
        'uses'=>'ScheduleController@destroy'
    ]);
    Route::get('admin/invoice',[
        'middleware'=>'acl_access::admin/invoice',
        'as'=>'admin.invoice',
        'uses'=>'InvoiceController@index'
    ]);
    Route::get('admin/invoice/{id}',[
        'middleware'=>'acl_access::admin/invoice/{id}',
        'as'=>'admin.invoice',
        'uses'=>'InvoiceController@index'
    ]);
    Route::get('admin/invoice/view/{id}',[
        'middleware'=>'acl_access::admin/invoice/view/{id}',
        'as'=>'admin.invoice.view',
        'uses'=>'InvoiceController@show'
    ]);
    Route::get('admin/invoice/change_status/{id}',[
        'middleware'=>'acl_access::admin/invoice/change_status/{id}',
        'as'=>'admin.invoice.change_status',
        'uses'=>'InvoiceController@edit'
    ]);
    Route::get('admin/invoice/delete/{id}',[
        'middleware'=>'acl_access::admin/invoice/delete/{id}',
        'as'=>'admin.invoice.delete',
        'uses'=>'InvoiceController@destroy'
    ]);
    Route::get('admin/invoice/update_status/{status}/{id}',[
        'middleware'=>'acl_access::admin/invoice/update_status/{status}/{id}',
        'as'=>'admin.invoice.update_status',
        'uses'=>'InvoiceController@change_status'
    ]);
    Route::get('admin/lead',[
        'middleware'=>'acl_access::admin/lead',
        'as'=>'admin.lead',
        'uses'=>'LeadController@index'
    ]);
    Route::get('admin/lead/{id}',[
        'middleware'=>'acl_access::admin/lead/{id}',
        'as'=>'admin.lead',
        'uses'=>'LeadController@index'
    ]);
    Route::any('lead-archive',[
        'as'=>'lead-archive',
        'uses'=>'LeadController@lead_archive'
    ]);
    Route::get('admin/lead-archive/{file_name?}',[
        'as'=>'admin.lead-archive',
        'uses'=>'LeadController@archive_leads'
    ]);



    Route::get('admin/lead-archive/keyword-based/{invoice_id)',[
        'as'=>'admin.lead-archive.keyword-based',
        'uses'=>'LeadController@get_lead_by_keyword_type'
    ]);

    Route::get('admin/lead-archive/without-keyword/{invoice_id)',[
        'as'=>'admin.lead-archive.without-keyword',
        'uses'=>'LeadController@get_lead_without_keyword'
    ]);


    Route::get('admin/lead-archive/get-download/{file_name?}',[
        'as'=>'admin.lead-archive.get-download',
        'uses'=>'LeadController@get_download'
    ]);

});
