@extends('admin::layouts.login')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="text-center m-b-sm">
                <div id="logo-login" class="light-version">
                    <!--<img src="<?php //echo e(URL::to('/')); ?>/assets/img/logo-dark.png" alt="SOP" class="bgm_logo_img">-->
                    <h3>Online Platform</h3>
                </div>
                <br clear="all" />
            </div>
            <div class="hpanel">
                <div class="panel-body">
                    <br>
                    {!! Form::open(['route' => 'post-user-login','id'=>'form_2']) !!}
                        <div class="form-group">
                            <label class="control-label" for="username">Username Or Email Address</label>
                            {!! Form::text('email', Input::old('email'), ['class' => 'form-control','required','placeholder'=>'Username or email','autofocus','title'=>'Enter Email Address/Username']) !!}
                            <span class="help-block small">Your unique username/email to app</span>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="password">Password</label>
                            {!! Form::password('password', ['class'=>'form-control', 'placeholder'=>'Password', 'required'=>'required','title'=>'Enter Password']) !!}
                            <span class="help-block small">Your strong password</span>
                        </div>
                        <div class="checkbox">
                            <input type="checkbox" class="i-checks" checked>
                            Remember login
                            <p>
                                <a href="{{ route('forget-password-view') }}" class="pull-right" style="text-decoration: underline">Forgot your password?</a>
                            </p>
                            <p class="help-block small">(if this is a private computer)</p>

                        </div>



                        <button class="btn btn-success btn-block">Login</button>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@stop

