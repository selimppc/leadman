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
                <a class="btn-sm btn-success pull-right paste-blue-button-bg" data-toggle="modal" href="#addData">
                    <strong>Add Schedule</strong>
                </a>
            </header>


            <div class="panel-body">
                <div class="adv-table">


                    {{-------------- Filter :Starts -------------------------------------------}}

                    <table  class="display table table-bordered table-striped" id="data-table-example">
                        <thead>
                        <tr>
                            <th> Id </th>
                            <th> Day </th>
                            <th> Time </th>
                            <th> Action </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($schedules as $schedule)
                            <tr class="gradeX">
                                <td>{!!  $schedule->id !!}</td>
                                <td>{!!  $schedule->day !!}</td>
                                <td>{!!  $schedule->time !!}</td>
                                <td>
                                    <a href="{!! url('admin/schedule/edit', $schedule->id) !!}" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#etsbModal" title="Filter Edit"><i class="icon-edit"></i> </a>
                                    <a href="{!!  url('admin/schedule/delete', $schedule->id) !!}" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure to delete')" title="Filter Delete"><i class="icon-trash"></i> </a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
{{--                    <span class="pull-right">{!! str_replace('/?', '?', $data->render()) !!} </span>--}}
                </div>
            </div>
        </section>
    </div>
</div>
<!-- page end-->


<!-- addData -->
<div class="modal fade" id="addData" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Add Schedule</h4>
            </div>
            <div class="modal-body">
                {!! Form::open(['url' => 'admin/schedule']) !!}
                @include('admin::schedule._form')
                {!! Form::close() !!}

            </div>

        </div>
    </div>
</div>
<!-- modal -->


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