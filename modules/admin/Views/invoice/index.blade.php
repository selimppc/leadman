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
                    {!! Form::open() !!}
                    <div class="form-group">
                        <div class="col-md-3">
                            {!! Form::email('email',null,['class'=>'form-control','placeholder'=>'Email']) !!}
                        </div>
                        <div class="col-md-3">
                            {!! Form::text('invoice_number',null,['class'=>'form-control','placeholder'=>'Invoice Number']) !!}
                        </div>
                        <div class="col-md-3">
                            <?php
                            $status=Config::get('custom.invoice_status');
                            ?>
                            {!! Form::select('status',['select'=>'select']+$status,null,['class'=>'form-control','placeholder'=>'Invoice Number']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                    {{-------------- Filter :End -------------------------------------------}}

                    <table  class="display table table-bordered table-striped" id="data-table-example">
                        <thead>
                        <tr>
                            <th> Id </th>
                            <th> Email </th>
                            <th> Invoice Number </th>
                            <th> Total Cost </th>
                            <th> Status </th>
                            <th> Action </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($invoices as $invoice)
                            <tr class="gradeX">
                                <td>{!!  $invoice->id !!}</td>
                                <td>{!!  $invoice->relPoppingEmail['email'] !!}</td>
                                <td>{!!  $invoice->invoice_number !!}</td>
                                <td>{!!  $invoice->status !!}</td>
                                <td>{!!  $invoice->total_cost !!}</td>
                                <td>
                                    <a href="{!! url('admin/invoice/view', $invoice->id) !!}" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#etsbModal" title="Invoice Details"><i class="icon-eye-open"></i> </a>
                                    <a href="{!!  url('admin/invoice/delete', $invoice->id) !!}" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure to delete')" title="Filter Delete"><i class="icon-trash"></i> </a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    <span class="pull-right">{!! str_replace('/?', '?', $invoices->render()) !!} </span>
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