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
                    { day: '2014-03-10', v: 20 },
                    { day: '2014-03-11', v: 10 },
                    { day: '2014-03-12', v: 15 },
                    { day: '2014-03-13', v: 12 },
                    { day: '2014-03-14', v: 5  },
                    { day: '2014-03-15', v: 5  },
                    { day: '2014-03-16', v: 20 }
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

            <div class="stat-cell col-sm-12 padding-sm-hr bordered no-border-r valign-top">
                <!-- Small padding, without top padding, extra small horizontal padding -->
                <h4 class="padding-sm no-padding-t padding-xs-hr"><i class="fa fa-cloud-upload text-primary"></i> 24 Hours </h4>
                <!-- Without margin -->

                <table class="display table table-bordered table-striped" >
                    <thead>
                    <tr>
                        <th>User Name</th>
                        <th>No of Popping Email</th>
                        <th>No of Lead</th>
                        <th>No of Invoice</th>
                        <th>Total Cost</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(isset($last_day))
                        @foreach($last_day as $last_day)
                            <tr>
                                <td>{{ $last_day->username }}</td>
                                <td>{{ $last_day->no_of_popping_email }}</td>
                                <td>{{ $last_day->no_of_lead }}</td>
                                <td>{{ $last_day->no_of_invoice }}</td>
                                <td>{{ $last_day->total_cost }}</td>
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
    <div class="col-md-12">

        <!-- Javascript -->
        <script>
            init.push(function () {
                var uploads_data = [
                    { day: '2014-03-10', v: 20 },
                    { day: '2014-03-11', v: 10 },
                    { day: '2014-03-12', v: 15 },
                    { day: '2014-03-13', v: 12 },
                    { day: '2014-03-14', v: 5  },
                    { day: '2014-03-15', v: 5  },
                    { day: '2014-03-16', v: 20 }
                ];
                Morris.Line({
                    element: 'last_7day',
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


            {{--<div class="stat-cell col-sm-5 bg-primary padding-sm valign-middle">
                <div id="last_7day" class="graph" style="height: 230px;"></div>
            </div>--}}
            <div class="stat-cell col-sm-12 padding-sm-hr bordered no-border-r valign-top">
                <!-- Small padding, without top padding, extra small horizontal padding -->
                <h4 class="padding-sm no-padding-t padding-xs-hr"><i class="fa fa-cloud-upload text-primary"></i> Last 7 Days </h4>
                <!-- Without margin -->

                <table class="display table table-bordered table-striped" >
                    <thead>
                    <tr>
                        <th>User Name</th>
                        <th>No of Popping Email</th>
                        <th>No of Lead</th>
                        <th>No of Invoice</th>
                        <th>Total Cost</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(isset($last_7day))
                        @foreach($last_7day as $last_7day)
                            <tr>
                                <td>{{ $last_7day->username }}</td>
                                <td>{{ $last_7day->no_of_popping_email }}</td>
                                <td>{{ $last_7day->no_of_lead }}</td>
                                <td>{{ $last_7day->no_of_invoice }}</td>
                                <td>{{ $last_7day->total_cost }}</td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>

            </div>

        </div>
    </div>
    <div class="col-md-12">

        <!-- Javascript -->
        <script>
            init.push(function () {
                var uploads_data = [
                    { day: '2014-03-10', v: 20 },
                    { day: '2014-03-11', v: 10 },
                    { day: '2014-03-12', v: 15 },
                    { day: '2014-03-13', v: 12 },
                    { day: '2014-03-14', v: 5  },
                    { day: '2014-03-15', v: 5  },
                    { day: '2014-03-16', v: 20 }
                ];
                Morris.Line({
                    element: 'user_leads',
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
            <div class="stat-cell col-sm-12 padding-sm-hr bordered no-border-r valign-top">
                <!-- Small padding, without top padding, extra small horizontal padding -->
                <h4 class="padding-sm no-padding-t padding-xs-hr"><i class="fa fa-cloud-upload text-primary"></i> User Wise Leads </h4>
                <!-- Without margin -->

                <table class="display table table-bordered table-striped" >
                    <thead>
                    <tr>
                        <th>Username</th>
                        <th>Popping Email</th>
                        <th>No of Lead</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(isset($user_leads))
                        @foreach($user_leads as $user_lead)
                            <tr>
                                <td>{{ $user_lead->username }}</td>
                                <td>{{ $user_lead->no_of_popping_email }}</td>
                                <td>{{ $user_lead->total_lead }}</td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>

            </div>


            {{--<div class="stat-cell col-sm-5 bg-primary padding-sm valign-middle">
                <div id="user_leads" class="graph" style="height: 230px;"></div>
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
                <h4 class="padding-sm no-padding-t padding-xs-hr"><i class="fa fa-cloud-upload text-primary"></i> Total Paid Invoices </h4>
                <!-- Without margin -->

                <table class="display table table-bordered table-striped" >
                    <thead>
                    <tr>
                        <th>Username</th>
                        <th>Total Paid Invoices</th>
                        <th>Total Cost</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(isset($user_invoices_paid))
                        @foreach($user_invoices_paid as $user_invoice_paid)
                            <tr>
                                <td>{{ $user_invoice_paid->username }}</td>
                                <td>{{ $user_invoice_paid->total_invoice }}</td>
                                <td>{{ $user_invoice_paid->total_cost }}</td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>

            </div>



        </div>
    </div>
    <div class="col-md-12">

        <!-- Javascript -->
        <script>
            init.push(function () {
                var invoice_approved = [
                    { day: '2014-03-10', v: 20 },
                    { day: '2014-03-11', v: 10 },
                    { day: '2014-03-12', v: 15 },
                    { day: '2014-03-13', v: 12 },
                    { day: '2014-03-14', v: 5  },
                    { day: '2014-03-15', v: 5  },
                    { day: '2014-03-16', v: 20 }
                ];
                Morris.Line({
                    element: 'invoice_approved',
                    data: invoice_approved,
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
            <div class="stat-cell col-sm-12 padding-sm-hr bordered no-border-r valign-top">
                <!-- Small padding, without top padding, extra small horizontal padding -->
                <h4 class="padding-sm no-padding-t padding-xs-hr"><i class="fa fa-cloud-upload text-primary"></i> Total Approved Invoices </h4>
                <!-- Without margin -->

                <table class="display table table-bordered table-striped" >
                    <thead>
                    <tr>
                        <th>Username</th>
                        <th>Total Approved Invoices</th>
                        <th>Total Cost</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(isset($user_invoices_approved))
                        @foreach($user_invoices_approved as $user_invoice_approved)
                            <tr>
                                <td>{{ $user_invoice_approved->username }}</td>
                                <td>{{ $user_invoice_approved->total_invoice }}</td>
                                <td>{{ $user_invoice_approved->total_cost }}</td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>

            </div>
            {{--<div class="stat-cell col-sm-5 bg-primary padding-sm valign-middle">
                <div id="invoice_approved" class="graph" style="height: 230px;"></div>
            </div>--}}



        </div>
    </div>
    <div class="col-md-12">

        <!-- Javascript -->
        <script>
            init.push(function () {
                var invoice_approve = [
                    { day: '2014-03-10', v: 20 },
                    { day: '2014-03-11', v: 10 },
                    { day: '2014-03-12', v: 15 },
                    { day: '2014-03-13', v: 12 },
                    { day: '2014-03-14', v: 5  },
                    { day: '2014-03-15', v: 5  },
                    { day: '2014-03-16', v: 20 }
                ];
                Morris.Line({
                    element: 'duplicate_leads',
                    data: invoice_approve,
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
            {{--<div class="stat-cell col-sm-5 bg-primary padding-sm valign-middle">--}}
                {{--<div id="duplicate_leads" class="graph" style="height: 230px;"></div>--}}
            {{--</div>--}}
            <div class="stat-cell col-sm-12 padding-sm-hr bordered no-border-r valign-top">
                <!-- Small padding, without top padding, extra small horizontal padding -->
                <h4 class="padding-sm no-padding-t padding-xs-hr"><i class="fa fa-cloud-upload text-primary"></i> User Lead Status</h4>
                <!-- Without margin -->

                <table class="display table table-bordered table-striped" >
                    <thead>
                    <tr>
                        <th>Username</th>
                        <th>Email</th>
                        <th>No of Duplicate Leads</th>
                        <th>No of Filtered Leads</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(isset($user_lead_status))
                        @foreach($user_lead_status as $duplicate_lead)
                            <tr>
                                <td>{{ $duplicate_lead->username }}</td>
                                <td>{{ $duplicate_lead->email }}</td>
                                <td>{{ $duplicate_lead->duplicate_leads }}</td>
                                <td>{{ $duplicate_lead->filtered_leads }}</td>
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
<script src="{{ URL::asset('assets/landerapp/js/bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('assets/landerapp/js/landerapp.min.js') }}"></script>

<script type="text/javascript">
    init.push(function () {
        // Javascript code here
    })
    window.LanderApp.start(init);
</script>

@stop