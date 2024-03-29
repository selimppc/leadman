@extends('admin::layouts.master')
@section('sidebar')
@parent
@include('admin::layouts.sidebar')
@stop

@section('content')

<!-- LanderApp's stylesheets -->
<link href="{{ URL::asset('assets/landerapp/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" >
<link href="{{ URL::asset('assets/landerapp/css/landerapp.min.css') }}" rel="stylesheet" type="text/css" >
<script>var init = [];</script>

<h1> Dashboard </h1>

<div class="row">
    <div class="col-md-12">

        <!-- Javascript -->
        <script>
            init.push(function () {
                var uploads_data = [
                    { day: '2014-03-10', v: 1 },
                    { day: '2014-03-11', v: 2 },
                    { day: '2014-03-12', v: 3 },
                    { day: '2014-03-13', v: 4 },
                    { day: '2014-03-14', v: 5 },
                    { day: '2014-03-15', v: 6 },
                    { day: '2014-03-16', v: 7 }
                ];
                Morris.Line({
                    element: 'hero-graph',
                    data: uploads_data,
                    xkey: 'day',
                    ykeys: ['v'],
                    labels: ['Value'],
                    lineColors: ['#fff'],
                    lineWidth: 2,
                    pointSize: 4,
                    gridLineColor: 'rgba(255,255,255,.5)',
                    resize: true,
                    gridTextColor: '#fff',
                    xLabels: "day",
                    xLabelFormat: function(d) {
                        return ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov', 'Dec'][d.getMonth()] + ' ' + d.getDate();
                    },
                });
            });
        </script>
        <!-- / Javascript -->


        <div class="stat-panel">

            <div class="stat-cell col-sm-7 padding-sm-hr bordered no-border-r valign-top">
                <!-- Small padding, without top padding, extra small horizontal padding -->
                <h4 class="padding-sm no-padding-t padding-xs-hr"><i class="fa fa-cloud-upload text-primary"></i> 24 Hours </h4>
                <!-- Without margin -->

                <table class="display table table-bordered table-striped" >
                    <thead>
                        <tr>
                            <th>Popping Email</th>
                            <th>No of Lead</th>
                            <th>Lead Cost</th>
                            <th>No of Duplicate Lead</th>
                            {{--<th>No of Invoice</th>
                            <th>Invoice Cost</th>--}}
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($result_24))
                            @foreach($result_24 as $result_24)
                                <tr>
                                    <td>{{ $result_24->email }}</td>
                                    <td>{{ $result_24->no_of_lead }}</td>
                                    <td>{{ $result_24->lead_cost }}</td>
                                    <td>{{ $result_24->duplicate_lead }}</td>
                                    {{--<td>{{ $result_24->no_of_invoice }}</td>
                                    <td>{{ $result_24->invoice_cost }}</td>--}}
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>

            </div>


            {{--<div class="stat-cell col-sm-5 bg-primary padding-sm valign-middle">
                <div id="hero-graph" class="graph" style="height: 230px;"></div>
            </div>--}}
        </div>
    </div>

</div>



<div class="row">
    <div class="col-md-12">

        <!-- Javascript -->
        <script>
            init.push(function () {
                var uploads_data = [
                    { day: '2014-03-10', v: 1 },
                    { day: '2014-03-11', v: 2 },
                    { day: '2014-03-12', v: 3 },
                    { day: '2014-03-13', v: 4 },
                    { day: '2014-03-14', v: 5 },
                    { day: '2014-03-15', v: 6 },
                    { day: '2014-03-16', v: 7 }
                ];
                Morris.Line({
                    element: 'result-7-days',
                    data: uploads_data,
                    xkey: 'day',
                    ykeys: ['v'],
                    labels: ['Value'],
                    lineColors: ['#fff'],
                    lineWidth: 2,
                    pointSize: 4,
                    gridLineColor: 'rgba(255,255,255,.5)',
                    resize: true,
                    gridTextColor: '#fff',
                    xLabels: "day",
                    xLabelFormat: function(d) {
                        return ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov', 'Dec'][d.getMonth()] + ' ' + d.getDate();
                    },
                });
            });
        </script>
        <!-- / Javascript -->


        <div class="stat-panel">

            <div class="stat-cell col-sm-7 padding-sm-hr bordered no-border-r valign-top">
                <!-- Small padding, without top padding, extra small horizontal padding -->
                <h4 class="padding-sm no-padding-t padding-xs-hr"><i class="fa fa-cloud-upload text-primary"></i> Last 7 Days  </h4>
                <!-- Without margin -->

                <table class="display table table-bordered table-striped" >
                    <thead>
                    <tr>
                        <th>Popping Email</th>
                        <th>No of Lead</th>
                        <th>Lead Cost</th>
                        <th>No of Duplicate Lead</th>
                        {{--<th>No of Invoice</th>
                        <th>Invoice Cost</th>--}}
                    </tr>
                    </thead>
                    <tbody>
                    @if(isset($result_7_days))
                        @foreach($result_7_days as $result_7_days)
                            <tr>
                                <td>{{ $result_7_days->email }}</td>
                                <td>{{ $result_7_days->no_of_lead }}</td>
                                <td>{{ $result_7_days->lead_cost }}</td>
                                <td>{{ $result_7_days->duplicate_lead }}</td>
                                {{--<td>{{ $result_7_days->no_of_invoice }}</td>
                                <td>{{ $result_7_days->invoice_cost }}</td>--}}
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>

            </div>


            {{--<div class="stat-cell col-sm-5 bg-primary padding-sm valign-middle">
                <div id="result-7-days" class="graph" style="height: 230px;"></div>
            </div>--}}
        </div>
    </div>

</div>



<div class="row">
    <div class="col-md-12">

        <!-- Javascript -->
        <script>
            init.push(function () {
                var uploads_data = [
                    { day: '2014-03-10', v: 1 },
                    { day: '2014-03-11', v: 2 },
                    { day: '2014-03-12', v: 3 },
                    { day: '2014-03-13', v: 4 },
                    { day: '2014-03-14', v: 5 },
                    { day: '2014-03-15', v: 6 },
                    { day: '2014-03-16', v: 7 }
                ];
                Morris.Line({
                    element: 'no-of-email',
                    data: uploads_data,
                    xkey: 'day',
                    ykeys: ['v'],
                    labels: ['Value'],
                    lineColors: ['#fff'],
                    lineWidth: 2,
                    pointSize: 4,
                    gridLineColor: 'rgba(255,255,255,.5)',
                    resize: true,
                    gridTextColor: '#fff',
                    xLabels: "day",
                    xLabelFormat: function(d) {
                        return ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov', 'Dec'][d.getMonth()] + ' ' + d.getDate();
                    },
                });
            });
        </script>
        <!-- / Javascript -->


        <div class="stat-panel">

            <div class="stat-cell col-sm-7 padding-sm-hr bordered no-border-r valign-top">
                <!-- Small padding, without top padding, extra small horizontal padding -->
                <h4 class="padding-sm no-padding-t padding-xs-hr"><i class="fa fa-cloud-upload text-primary"></i> Email Lists  </h4>
                <!-- Without margin -->

                <table class="display table table-bordered table-striped" >
                    <thead>
                    <tr>
                        <th>Popping Email</th>
                        <th>No of Lead</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(isset($no_of_email))
                        @foreach($no_of_email as $no_of_email)
                            <tr>
                                <td>{{ $no_of_email->email }}</td>
                                <td>{{ $no_of_email->no_of_lead }}</td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>

            </div>


            {{--<div class="stat-cell col-sm-5 bg-primary padding-sm valign-middle">
                <div id="no-of-email" class="graph" style="height: 230px;"></div>
            </div>--}}
        </div>
    </div>

</div>



{{--Duplicate Email Lists --}}

<div class="row">
    <div class="col-md-12">

        <!-- Javascript -->
        <script>
            init.push(function () {
                var uploads_data = [
                    { day: '2014-03-10', v: 1 },
                    { day: '2014-03-11', v: 2 },
                    { day: '2014-03-12', v: 3 },
                    { day: '2014-03-13', v: 4 },
                    { day: '2014-03-14', v: 5 },
                    { day: '2014-03-15', v: 6 },
                    { day: '2014-03-16', v: 7 }
                ];
                Morris.Line({
                    element: 'duplicate-email-lists',
                    data: uploads_data,
                    xkey: 'day',
                    ykeys: ['v'],
                    labels: ['Value'],
                    lineColors: ['#fff'],
                    lineWidth: 2,
                    pointSize: 4,
                    gridLineColor: 'rgba(255,255,255,.5)',
                    resize: true,
                    gridTextColor: '#fff',
                    xLabels: "day",
                    xLabelFormat: function(d) {
                        return ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov', 'Dec'][d.getMonth()] + ' ' + d.getDate();
                    },
                });
            });
        </script>
        <!-- / Javascript -->


        {{--<div class="stat-panel">

            <div class="stat-cell col-sm-7 padding-sm-hr bordered no-border-r valign-top">
                <!-- Small padding, without top padding, extra small horizontal padding -->
                <h4 class="padding-sm no-padding-t padding-xs-hr"><i class="fa fa-cloud-upload text-primary"></i> Duplicate Email Lists  </h4>
                <!-- Without margin -->

                <table class="display table table-bordered table-striped" >
                    <thead>
                    <tr>
                        <th>Popping Email</th>
                        <th>No of Lead</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(isset($no_duplicate_email))
                        @foreach($no_duplicate_email as $no_duplicate_email)
                            <tr>
                                <td>{{ $no_duplicate_email->email }}</td>
                                <td>{{ $no_duplicate_email->no_of_lead }}</td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>

            </div>--}}


            {{--<div class="stat-cell col-sm-5 bg-primary padding-sm valign-middle">
                <div id="duplicate-email-lists" class="graph" style="height: 230px;"></div>
            </div>--}}
        </div>
    </div>

</div>


{{--Filtered Email Lists --}}

<div class="row">
    <div class="col-md-12">

        <!-- Javascript -->
        <script>
            init.push(function () {
                var uploads_data = [
                    { day: '2014-03-10', v: 1 },
                    { day: '2014-03-11', v: 2 },
                    { day: '2014-03-12', v: 3 },
                    { day: '2014-03-13', v: 4 },
                    { day: '2014-03-14', v: 5 },
                    { day: '2014-03-15', v: 6 },
                    { day: '2014-03-16', v: 7 }
                ];
                Morris.Line({
                    element: 'filtered-email-lists',
                    data: uploads_data,
                    xkey: 'day',
                    ykeys: ['v'],
                    labels: ['Value'],
                    lineColors: ['#fff'],
                    lineWidth: 2,
                    pointSize: 4,
                    gridLineColor: 'rgba(255,255,255,.5)',
                    resize: true,
                    gridTextColor: '#fff',
                    xLabels: "day",
                    xLabelFormat: function(d) {
                        return ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov', 'Dec'][d.getMonth()] + ' ' + d.getDate();
                    },
                });
            });
        </script>
        <!-- / Javascript -->


        <div class="stat-panel">

            <div class="stat-cell col-sm-7 padding-sm-hr bordered no-border-r valign-top">
                <!-- Small padding, without top padding, extra small horizontal padding -->
                <h4 class="padding-sm no-padding-t padding-xs-hr"><i class="fa fa-cloud-upload text-primary"></i> Filtered Email Lists  </h4>
                <!-- Without margin -->

                <table class="display table table-bordered table-striped" >
                    <thead>
                    <tr>
                        <th>Popping Email</th>
                        <th>No of Lead</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(isset($no_filtered_email))
                        @foreach($no_filtered_email as $no_filtered_email)
                            <tr>
                                <td>{{ $no_filtered_email->email }}</td>
                                <td>{{ $no_filtered_email->no_of_lead }}</td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>

            </div>


            {{--<div class="stat-cell col-sm-5 bg-primary padding-sm valign-middle">
                <div id="filtered-email-lists" class="graph" style="height: 230px;"></div>
            </div>--}}
        </div>
    </div>
    <div class="col-md-12">

        <!-- Javascript -->
        <script>
            init.push(function () {
                var invoice_paid = [
                    { day: '2014-03-10', v: 20 },
                    { day: '2014-03-11', v: 10 },
                    { day: '2014-03-12', v: 15 },
                    { day: '2014-03-13', v: 12 },
                    { day: '2014-03-14', v: 5  },
                    { day: '2014-03-15', v: 5  },
                    { day: '2014-03-16', v: 20 }
                ];
                Morris.Line({
                    element: 'invoice_paid',
                    data: invoice_paid,
                    xkey: 'day',
                    ykeys: ['v'],
                    labels: ['Value'],
                    lineColors: ['#fff'],
                    lineWidth: 2,
                    pointSize: 4,
                    gridLineColor: 'rgba(255,255,255,.5)',
                    resize: true,
                    gridTextColor: '#fff',
                    xLabels: "day",
                    xLabelFormat: function(d) {
                        return ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov', 'Dec'][d.getMonth()] + ' ' + d.getDate();
                    },
                });
            });
        </script>
        <!-- / Javascript -->


        <div class="stat-panel">
            {{--<div class="stat-cell col-sm-5 bg-primary padding-sm valign-middle">
                <div id="invoice_paid" class="graph" style="height: 230px;"></div>
            </div>--}}
            <div class="stat-cell col-sm-12 padding-sm-hr bordered no-border-r valign-top">
                <!-- Small padding, without top padding, extra small horizontal padding -->
                <h4 class="padding-sm no-padding-t padding-xs-hr"><i class="fa fa-cloud-upload text-primary"></i> User Invoice Status </h4>
                <!-- Without margin -->

                <table class="display table table-bordered table-striped" >
                    <thead>
                    <tr>
                        <th>Total Open Invoices</th>
                        <th>Total Approved Invoices</th>
                        <th>Total Paid Invoices</th>
                        <th>Total Cost</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(isset($invoice_status))
                        @foreach($invoice_status as $user_invoice)
                            <tr>
                                <td>{{ $user_invoice->open_invoice }}</td>
                                <td>{{ $user_invoice->approved_invoice }}</td>
                                <td>{{ $user_invoice->paid_invoice }}</td>
                                <td>{{ $user_invoice->total_cost }}</td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>

            </div>



        </div>
    </div>
</div>

<script type="text/javascript"> window.jQuery || document.write('<script src="{{ URL::asset('assets/landerapp/js/jquery.min.js') }}">'+"<"+"/script>"); </script>

<!-- LanderApp's javascripts -->
{{--<script src="{{ URL::asset('assets/landerapp/js/bootstrap.min.js') }}"></script>--}}
<script src="{{ URL::asset('assets/landerapp/js/landerapp.min.js') }}"></script>

<script type="text/javascript">
    init.push(function () {
        // Javascript code here
    })
    window.LanderApp.start(init);
</script>

@stop