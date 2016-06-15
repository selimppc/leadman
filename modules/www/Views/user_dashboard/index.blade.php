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

            <div class="stat-cell col-sm-7 padding-sm-hr bordered no-border-r valign-top">
                <!-- Small padding, without top padding, extra small horizontal padding -->
                <h4 class="padding-sm no-padding-t padding-xs-hr"><i class="fa fa-cloud-upload text-primary"></i> 24 Hours </h4>
                <!-- Without margin -->

                <table class="display table table-bordered table-striped" >
                    <thead>
                        <tr>
                            <th>Popping Email</th>
                            <th>No of Lead</th>
                            <th>No of Invoice</th>
                            <th>Total Cost</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                        </tr>
                    </tbody>
                </table>

            </div>


            <div class="stat-cell col-sm-5 bg-primary padding-sm valign-middle">
                <div id="hero-graph" class="graph" style="height: 230px;"></div>
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