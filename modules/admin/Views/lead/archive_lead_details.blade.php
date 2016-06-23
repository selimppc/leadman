@extends('admin::layouts.master')
@section('sidebar')
@parent
@include('admin::layouts.sidebar')
@stop

@section('content')

        <!-- page start-->
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                {{ $pageTitle }}
                <a href="{!! URL::previous() !!}" class="btn btn-danger btn-sm pull-right">Back</a>
            </header>


            <div class="panel-body">
                <div class="adv-table">
                    {!! nl2br($file_content) !!}
                    {{--<span class="pull-right">{!! $leads->appends( $_REQUEST ) !!} </span>--}}
                </div>
            </div>
        </section>
    </div>
</div>
@stop