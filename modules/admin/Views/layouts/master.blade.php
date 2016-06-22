<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Selim Reza">
    <meta name="keyword" content="Edu Tech Solutions">
    <link rel="shortcut icon" href="assets/img/favicon.png">

    <title>Leadman</title>
    {{--<title>{{ isset($pageTitle) ? $pageTitle : "CCMS" }} </title>--}}

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />

    <link href="{{ URL::asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" >
    <link href="{{ URL::asset('assets/css/bootstrap-reset.css') }}" rel="stylesheet" type="text/css" >

    <!--external css-->
    <link href="{{ URL::asset('assets/font-awesome/css/font-awesome.css') }}" rel="stylesheet" type="text/css" >
    <link href="{{ URL::asset('assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css') }}" rel="stylesheet" type="text/css" >
    <link href="{{ URL::asset('assets/css/owl.carousel.css') }}" rel="stylesheet" type="text/css" >

    <!-- Data Tables -->
    <link href="{{ URL::asset('assets/advanced-datatable/media/css/demo_page.css') }}" rel="stylesheet" type="text/css" >
    <link href="{{ URL::asset('assets/advanced-datatable/media/css/demo_table.css') }}" rel="stylesheet" type="text/css" >

    <!-- Custom styles for this ui_elements -->
    <link href="{{ URL::asset('assets/css/style.css') }}" rel="stylesheet" type="text/css" >
    <link href="{{ URL::asset('assets/css/style-responsive.css') }}" rel="stylesheet" type="text/css" >

    {{--<script type="text/javascript" src="{{ URL::asset('etsb/assets/jquery/jquery-2.1.4.min.js') }}"></script>--}}
    {{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>--}}
    <script type="text/javascript" src="{{ URL::asset('assets/js/jquery.js') }}"></script>

    <!-- Advanced Feature -->
    <link href="{{ URL::asset('assets/bootstrap-fileupload/bootstrap-fileupload.css') }}" rel="stylesheet" type="text/css" >
    <link href="{{ URL::asset('assets/bootstrap-wysihtml5/bootstrap-wysihtml5.css') }}" rel="stylesheet" type="text/css" >
    {{--<link href="{{ URL::asset('assets/assets/bootstrap-datepicker/css/datepicker.css') }}" rel="stylesheet" type="text/css" >
    <link href="{{ URL::asset('assets/bootstrap-timepicker/compiled/timepicker.css') }}" rel="stylesheet" type="text/css" >
    <link href="{{ URL::asset('assets/bootstrap-colorpicker/css/colorpicker.css') }}" rel="stylesheet" type="text/css" >
    <link href="{{ URL::asset('assets/bootstrap-daterangepicker/daterangepicker-bs3.css') }}" rel="stylesheet" type="text/css" >
    <link href="{{ URL::asset('assets/bootstrap-datetimepicker/css/datetimepicker.css') }}" rel="stylesheet" type="text/css" >--}}
    <link href="{{ URL::asset('assets/jquery-multi-select/css/multi-select.css') }}" rel="stylesheet" type="text/css" >


    <link href="{{ URL::asset('assets/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet" type="text/css" >


    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
    <script type="text/javascript" src="{{ URL::asset('assets/js/html5shiv.js') }}"></script>

    <![endif]-->
</head>

<body>

<section id="container" >
    <!--header start-->
    <header class="header white-bg">

        @include('admin::layouts.header')

    </header>
    <!--header end-->
    <!--sidebar start-->
    {{--@if(!isset($loginLayout))--}}
        <aside>
            <div id="sidebar"  class="nav-collapse ">
                <!-- sidebar menu start-->
                {{--<ul class="sidebar-menu" id="nav-accordion">--}}

                    {{--@section('sidebar')
                    @show--}}
                    @include('admin::layouts.sidebar')


                {{--</ul>--}}
                <!-- sidebar menu end-->
            </div>
        </aside>
    {{--@endif--}}
                <!--sidebar end-->
        <!--main content start-->
        <section id="main-content">
            <section class="wrapper">

                @if($errors->any())
                    <ul class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

                {{--set some message after action--}}
                @if (Session::has('message'))
                    <div class="alert alert-success">{{Session::get("message")}}</div>

                @elseif(Session::has('error'))
                    <div class="alert alert-warning">{{Session::get("error")}}</div>

                @elseif(Session::has('info'))
                    <div class="alert alert-info">{{Session::get("info")}}</div>

                @elseif(Session::has('danger'))
                    <div class="alert alert-danger">{{Session::get("danger")}}</div>
                @endif

                @yield('content')

                        <!-- Modal  -->
                        <div class="modal fade" id="leadPasswordModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 style="color: black">Please Enter Password</h4>
                                    </div>
                                    <div class="modal-body">

                                        {!! Form::open(['url'=>'lead-archive']) !!}
                                        <div class="row">
                                            <div class="col-md-3">
                                                {!! Form::label('Password') !!}
                                                <span class="required">*</span>
                                            </div>
                                            <div class="col-md-7">
                                                {!! Form::password('password',['class'=>'form-control','required'=>'required','autofocus']) !!}
                                            </div>
                                            <div class="col-md-2">
                                                {!! Form::submit('Continue',['class'=>'btn btn-primary']) !!}
                                            </div>
                                        </div>
                                        {!! Form::close() !!}

                                    </div>

                                    <div class="modal-footer">
                                        <a href="{{ URL::previous()}}" class="btn btn-default" type="button"> Close </a>
                                    </div>

                                </div>
                            </div>
                        </div>
                        @if (Session::has('leadArchive') && Session::get('leadArchive')=='yes')
                            <script type="text/javascript">
                                $(function(){
                                    $("#leadPasswordModal").modal('show');
                                });
                            </script>
                            @endif

                                    <!-- modal -->
            </section>
        </section>
        <!--main content end-->
        <!--footer start-->
        <footer class="site-footer">

            @include('admin::layouts.footer')

        </footer>
        <!--footer end-->



</section>
<!-- js placed at the end of the document so the pages load faster -->

<script type="text/javascript" src="{{ URL::asset('assets/js/jquery-1.8.min.js') }}"></script>
{{--<script type="text/javascript" src="{{ URL::asset('assets/js/jquery.min.js') }}"></script>--}}
<script type="text/javascript" src="{{ URL::asset('assets/js/bootstrap.min.js') }}"></script>

<script type="text/javascript" src="{{ URL::asset('assets/js/jquery.scrollTo.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/jquery.nicescroll.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/jquery.sparkline.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/owl.carousel.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/jquery.customSelect.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/respond.min.js') }}"></script>
<script class="include" type="text/javascript" src="{{ URL::asset('assets/js/jquery.dcjqaccordion.2.7.js') }}"></script>

<!--common script for all pages-->
<script type="text/javascript" src="{{ URL::asset('assets/js/common-scripts.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/sparkline-chart.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/easy-pie-chart.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/count.js') }}"></script>

<!--Data Tables script for all pages-->
{{--<script type="text/javascript" src="{{ URL::asset('etsb/assets/advanced-datatable/media/js/jquery.js') }}"></script>--}}
<script type="text/javascript" src="{{ URL::asset('assets/advanced-datatable/media/js/jquery.dataTables.js') }}"></script>

<!--Validation script for all pages-->
<script type="text/javascript" src="{{ URL::asset('assets/js/jquery.validate.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/form-validation-script.js') }}"></script>



<!--Advanced Feature plugins-->
<script type="text/javascript" src="{{ URL::asset('assets/fuelux/js/spinner.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/bootstrap-fileupload/bootstrap-fileupload.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/bootstrap-wysihtml5/wysihtml5-0.3.0.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/bootstrap-wysihtml5/bootstrap-wysihtml5.js') }}"></script>
{{--<script type="text/javascript" src="{{ URL::asset('assets/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/bootstrap-daterangepicker/moment.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/bootstrap-colorpicker/js/bootstrap-colorpicker.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/bootstrap-timepicker/js/bootstrap-timepicker.js') }}"></script>--}}
{{--<script type="text/javascript" src="{{ URL::asset('assets/jquery-multi-select/js/jquery.multi-select.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/jquery-multi-select/js/jquery.quicksearch.js') }}"></script>--}}

{{-- Date Picker --}}
<script type="text/javascript" src="{{ URL::asset('assets/js/bootstrap-datepicker.min.js') }}"></script>


<!--Advanced Form plugins-->
<script type="text/javascript" src="{{ URL::asset('assets/js/advanced-form-components.js') }}"></script>



<!--Custom S-->
<script>
    $(document).ready(function() {
        //data-table sorting
        $('#data-table-example').DataTable({
            "bProcessing": true,
            "bSort": true,
            "bLengthChange": false,
            "bPaginate": false,
            "oLanguage": {
                "sSearch": "Filter "
            }
        } );

        //owl carousel
        $("#owl-demo").owlCarousel({
            navigation : true,
            slideSpeed : 300,
            paginationSpeed : 400,
            singleItem : true,
            autoPlay:true
        });
    });

    //custom select box
    $(function(){
        $('select.styled').customSelect();
    });


    $(function(){

        $('.datapicker2').datepicker({
            format: 'yyyy-mm-dd (D)',
        });
        $('.input-group.date').datepicker({
        });
        $('.input-daterange').datepicker({ });

    });

    $(document).ready(function(){
        //data Tables
        $('#jq-datatables-example').DataTable();

        /*//date picker
        var date_input=$('input[id="date_id"]'); //our date input has the name "date"
        var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
        date_input.datepicker({
            format: 'yyyy-mm-dd',
            container: container,  // need more clarification
            todayHighlight: true,
            autoclose: true,
        })*/

        // For Content Full Screen
        /*$('.content-height-100').height($(window).height());*/
    })







</script>


</body>
</html>