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
                    <table class="table">
                        <tr>
                            <th>Id</th>
                            <th>Invoice Number</th>
                            <th>Popping Email</th>
                            <th>Status</th>
                            <th>Cost</th>
                        </tr>
                        <?php $i=1;$total_cost=0; ?>
                        @foreach($invoices as $invoice)
                            <tr>
                                <td>{!! $i++ !!}</td>
                                <td>{!! $invoice->invoice_number !!}</td>
                                <td>{!! $invoice->relPoppingEmail['email'] !!}</td>
                                <td>{!! ucfirst($invoice->status) !!}</td>
                                <td>{!! $invoice->total_cost !!}</td>
                                <?php $total_cost+=$invoice->total_cost; ?>
                            </tr>
                        @endforeach
                        <tr>
                            <th colspan="4" class="text-right">Total Cost</th>
                            <th>{!! $total_cost !!}</th>
                        </tr>
                    </table>
                    <a href="{{ \URL::previous() }}" class="btn btn-info">Back</a>
                </div>
            </section>
        </div>
    </div>
    <!-- page end-->

@stop