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



                    <table  class="display table table-bordered table-striped" id="data-table-example">
                        <thead>
                        <tr>
                            <th> Id </th>
                            <th> File Name </th>
                            <th> Download File </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=0; ?>
                        @foreach($archive_leads as $file)
                            <tr class="gradeX">
                                <td>{!!  ++$i !!}</td>
                                <td><a data-toggle="modal" data-target="#etsbModal" href="{{ url('admin/lead-archive/'.$file) }}">{!!  $file !!}</a></td>
                                <td><a href="{{ URL::to('admin/lead-archive/get-download/'.$file)}}" class="btn-xs btn-success" type="button"> <span class="glyphicon glyphicon-download-alt"> Download File </span> </a></td>
                            </tr>
                        @endforeach
                    </table>
                    {{--<span class="pull-right">{!! $leads->appends( $_REQUEST ) !!} </span>--}}
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