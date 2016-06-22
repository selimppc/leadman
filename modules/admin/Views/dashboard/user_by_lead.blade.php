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

        <div class="stat-panel">

            <div class="stat-cell col-sm-12 padding-sm-hr bordered no-border-r valign-top">
                <!-- Small padding, without top padding, extra small horizontal padding -->
                <h4 class="padding-sm no-padding-t padding-xs-hr"> Heading </h4>
                <!-- Without margin -->

                <table class="display table table-bordered table-striped" >
                    <thead>
                    <tr>
                        <th>Popint Email</th>
                        <th>Password</th>
                        <th>No of Lead</th>
                    </tr>
                    </thead>
                    <tbody>
                    {{--@if(isset($last_day))
                        @foreach($last_day as $last_day)
                            <tr>
                                <td>{{ $last_day->username }}</td>
                                <td>{{ $last_day->no_of_popping_email }}</td>
                                <td>{{ $last_day->no_of_lead }}</td>
                                <td>{{ $last_day->no_of_invoice }}</td>
                                <td>{{ $last_day->total_cost }}</td>
                            </tr>
                        @endforeach
                    @endif--}}
                            <tr>
                                <td>Poping Email</td>
                                <td>454545</td>
                                <td>45</td>
                            </tr>
                    </tbody>
                </table>

            </div>


            {{--<div class="stat-cell col-sm-5 bg-primary padding-sm valign-middle">
                <div id="hero-graph" class="graph" style="height: 230px;"></div>
            </div>--}}
        </div>
    </div>





</div>


<script type="text/javascript"> window.jQuery || document.write('<script src="{{ URL::asset('assets/landerapp/js/jquery.min.js') }}">'+"<"+"/script>"); </script>

<!-- LanderApp's javascripts -->
{{--<script src="{{ URL::asset('assets/landerapp/js/bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('assets/landerapp/js/landerapp.min.js') }}"></script>--}}

<script type="text/javascript">
    init.push(function () {
        // Javascript code here
    })
    window.LanderApp.start(init);
</script>

@stop