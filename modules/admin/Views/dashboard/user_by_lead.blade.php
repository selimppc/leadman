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

<h4> User wise Popping and Lead Stat </h4>

<div class="row">

    <div class="col-md-12">
        <p class="pull-right">
            <a class="btn-sm btn-success" href="{{ URL::previous() }}"> Back to Dashboard </a>
        </p>
        <div class="stat-panel">

            <div class="stat-cell col-sm-12 padding-sm-hr bordered no-border-r valign-top">
                <!-- Small padding, without top padding, extra small horizontal padding -->
                <h5 class="padding-sm no-padding-t padding-xs-hr"> All lists for the User of <b>{{Illuminate\Support\Str::upper($user_data->username)}}({{$user_data->email}})</b> </h5>
                <!-- Without margin -->

                <table class="display table table-bordered table-striped" >
                    <thead>
                    <tr>
                        <th>Popping Email</th>
                        <th>Password</th>
                        <th>No of Lead</th>
                        <th>No of Duplicate Leads</th>
                    </tr>
                    </thead>
                    <tbody>
                        @if(isset($result))
                            @foreach($result as $value)
                                <tr>
                                    <td>{{ isset($value->email)?$value->email:null }}</td>
                                    <td>{{ isset($value->password)?$value->password:null }}</td>
                                    <td>{{ isset($value->no_of_lead)?$value->no_of_lead:null }}</td>
                                    <td>{{ isset($value->duplicate_leads)?$value->duplicate_leads:null }}</td>
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