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
                            <th>Price</th>
                            <th>Total Lead</th>
                            <th>Status</th>
                            <th>Cost</th>
                        </tr>
                        <?php $i=1;$total_cost=0; ?>
                        @foreach($invoices as $invoice)
                            <tr>
                                <td>{!! $i++ !!}</td>
                                <td>{!! $invoice->invoice_number !!}</td>
                                <td>{!! $invoice->email !!}</td>
                                <td>{!! $invoice->price !!}</td>
                                <td>{!! $invoice->total_lead !!}</td>
                                <td>{!! ucfirst($invoice->status) !!}</td>
                                <td>{!! $invoice->total_cost !!}</td>
                                <?php $total_cost+=$invoice->total_cost; ?>
                            </tr>
                        @endforeach
                        @if($total_cost != 0)
                        <tr>
                            <th colspan="6" class="text-right">Total Cost</th>
                            <th>{!! $total_cost !!}</th>
                        </tr>
                        @else
                            <tr>
                                <th colspan="7" class="text-center">Sorry, No data found.</th>
                            </tr>
                        @endif
                    </table>
                    <a href="{{ \URL::previous() }}" class="btn btn-info">Back</a>
                </div>
            </section>
        </div>
    </div>
    <!-- page end-->

@stop