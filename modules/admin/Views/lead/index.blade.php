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


            <div class="panel-body">
                <div class="adv-table">

                    {{-------------- Filter :Start -------------------------------------------}}
                    {!! Form::model($_REQUEST,['url'=>'admin/lead','method'=>'get']) !!}
                    <div class="form-group">
                        <div class="col-md-5">
                            {!! Form::email('email',null,['class'=>'form-control','placeholder'=>'Popping Email']) !!}
                        </div>
                        <div class="col-md-3">
                            <?php
                            $status=Config::get('custom.lead_status');
                            ?>
                            {!! Form::select('status',['select'=>'Select status']+$status,null,['class'=>'form-control','placeholder'=>'Status']) !!}
                        </div>
                        <div class="col-md-1">
                            {!! Form::submit('Search',['class'=>'btn btn-warning']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                    {{-------------- Filter :End -------------------------------------------}}

                    <table  class="display table table-bordered table-striped" id="data-table-example">
                        <thead>
                        <tr>
                            <th> Id </th>
                            <th> Lead Email </th>
                            <th> Popping Email </th>
                            <th> Status </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($leads as $filter)
                            <tr class="gradeX">
                                <td>{!!  $filter->id !!}</td>
                                <td>{!!  $filter->email !!}</td>
                                <td>{!!  $filter->relPoppingEmail['email'] !!}</td>
                                <td>{!!  $filter->status !!}</td>
                            </tr>
                        @endforeach
                    </table>
                    <span class="pull-right">{!! $leads->appends( $_REQUEST ) !!} </span>
                </div>
            </div>
        </section>
    </div>
</div>
<!-- page end-->


<!-- addData -->
<div class="modal fade" id="addData" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Add Filter</h4>
            </div>
            <div class="modal-body">
                {!! Form::open(['url' => 'admin/filter']) !!}
                @include('admin::filter._form')
                {!! Form::close() !!}

            </div>

        </div>
    </div>
</div>
<!-- modal -->


<!-- Modal  -->
<div class="modal fade" id="etsbModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
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