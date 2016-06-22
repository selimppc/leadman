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
                    @if(isset($popping_email_id))
                        {!! Form::model($_REQUEST,['url'=>'admin/invoice/'.$popping_email_id,'method'=>'get']) !!}
                    @else
                        {!! Form::model($_REQUEST,['url'=>'admin/invoice','method'=>'get']) !!}
                    @endif
                    <div class="form-group">
                        {{--<div class="col-md-5">
                            {!! Form::email('popping_email',null,['class'=>'form-control','placeholder'=>'Popping Email']) !!}
                            <span class="required">**example@example.com**</span>
                        </div>--}}
                        <div class="col-md-5">
                            {!! Form::text('user_name',null,['class'=>'form-control','placeholder'=>'User Name']) !!}
                        </div>
                        <div class="col-md-3">
                            {!! Form::text('invoice_number',null,['class'=>'form-control','placeholder'=>'Invoice Number']) !!}
                        </div>
                        <div class="col-md-3">
                            <?php
                            $status=Config::get('custom.invoice_status');
                            ?>
                            {!! Form::select('status',['select'=>'Select status']+$status,null,['class'=>'form-control','placeholder'=>'Invoice Number']) !!}
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
                            <th> User </th>
                            {{--<th> Popping Email </th>--}}
                            <th> Invoice Number </th>
                            <th> Total Cost </th>
                            <th> Status </th>
                            <th> Action </th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(is_object($invoices))
                            @foreach($invoices as $invoice)
                                <tr class="gradeX">
                                    <td>{!!  $invoice->relUser->username !!}</td>
                                    {{--<td>{!!  $invoice->relPoppingEmail['email'] !!}</td>--}}
                                    <td>{!!  $invoice->invoice_number !!}</td>
                                    <td>{!!  $invoice->total_cost !!}</td>
                                    <td>{!!  $invoice->status !!}</td>
                                    <td>
                                        <a href="{!! url('admin/invoice/view', $invoice->id) !!}" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#etsbModal" title="Invoice Details"><i class="icon-eye-open"></i> </a>
                                        <a href="{!!  url('admin/invoice/delete', $invoice->id) !!}" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure to delete')" title="Filter Delete"><i class="icon-trash"></i> </a>
                                        @if($invoice->status=='open')
                                            <a onclick="return confirm('Are you confirm?')" href="{!! url('admin/invoice/update_status/approved/'.$invoice->id) !!}" class="btn btn-primary btn-xs" title="Change Status">
                                                Approve
                                            </a>
                                        @elseif($invoice->status=='approved')
                                            <a onclick="return confirm('Are you confirm?')" href="{!! url('admin/invoice/update_status/paid/'.$invoice->id) !!}" class="btn btn-primary btn-xs" title="Change Status">
                                                Paid
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                        @endforeach
                        @endif
                    </table>
                    @if(is_object($invoices))
                    <span class="pull-right">{!! $invoices->appends( $_REQUEST ) !!} </span>
                        @endif
                </div>
            </div>
        </section>
    </div>
</div>
<!-- page end-->


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