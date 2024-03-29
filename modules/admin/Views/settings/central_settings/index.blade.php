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
            </header>
            @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif
            @if(Session::has('flash_message'))
                <div class="alert alert-success">
                    <p>{{ Session::get('flash_message') }}</p>
                </div>
            @endif
            @if(Session::has('flash_message_error'))
                <div class="alert alert-danger">
                    <p>{{ Session::get('flash_message_error') }}</p>
                </div>
            @endif

            <div class="panel-body">

                <div class="adv-table">

                    <table  class="display table table-bordered table-striped" id="data-table-example">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th> Status </th>
                            <th> User Type </th>
                            <th>Action </th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($settings_data))
                            @foreach($settings_data as $row)
                                <tr class="gradeX">
                                    <td>{{preg_replace('~[-_]~',' ',$row->title)}}</td>
                                    <td>{{isset($row->status)?ucfirst($row->status):''}}</td>
                                    <td>{{isset($row->user_type)? ucfirst($row->user_type):''}}</td>
                                    <td>
                                        <a href="{{ route('central-settings-show', $row->id) }}" class="btn btn-info btn-xs" data-toggle="modal" data-target="#etsbModal" title="Settings View"><i class="icon-eye-open"></i></a>
                                        @if($row->title != 'invoice-number')
                                            <a href="{{ route('central-settings-edit', $row->id) }}" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#etsbModal" title="Settings Edit"><i class="icon-edit"></i></a>
                                        @endif
                                    </td>
                                </tr>
                        @endforeach
                        @endif
                    </table>
                    {{--<span class="pull-right">{!! str_replace('/?', '?', $data->render()) !!} </span>--}}
                </div>
            </div>
        </section>
    </div>
</div>
<!-- page end-->

{{--<div>
    user Role ID : {{ Auth::user()->role_id }}
</div>
<div>
    User ID From Session : {{ $ses_user_id }}
</div>--}}
{{--<div>
    User ID From Session : {{ Session::get('user_id') }}
</div>--}}




<!-- Modal  -->
<div class="modal fade" id="etsbModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
    slkdjflsdjf
</div>
<!-- modal -->

<!--script for this page only-->
@if($errors->any())
    <script type="text/javascript">
        $(function(){
            $("#addData").modal('show');
        });
    </script>
@endif

@stop