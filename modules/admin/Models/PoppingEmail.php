<?php
/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 6/12/16
 * Time: 4:19 PM
 */

namespace Modules\Admin;


use Illuminate\Database\Eloquent\Model;

class PoppingEmail extends Model
{
    protected $table='popping_email';
    protected $fillable=[
        'email',
        'password',
        'smtp_id',
        'imap_id',
        'country_orgin',
        'price',
        'schedule_id',
        'execution_time',
        'token',
        'code',
        'auth_id',
        'auth_type',
        'status',
        'user_id',
    ];
}