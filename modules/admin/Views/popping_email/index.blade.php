@extends('admin::layouts.master')
@section('sidebar')
    @parent
    @include('admin::layouts.sidebar')
@stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                {{ $pageTitle }}

                @if(Session::get('role_title') != 'admin')
                    <a class="btn-sm btn-success pull-right paste-blue-button-bg" data-toggle="modal" href="#addData">
                        <b>Add Popping Email</b>
                    </a>
                @endif
            </header>

            <div class="panel-body">
                <div class="adv-table">

                    {{-------------- Filter :Starts -------------------------------------------}}
                    {!! Form::model($_REQUEST,['url' => 'admin/popping-email','method'=>'get']) !!}
                    <div  class="col-md-2" >
                        <div class="form-group">
                            {!! Form::text('popmail_filter', null, ['id'=>'popmail_filter','placeholder'=>'Search by email','class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div  class="col-md-2" >
                        <div class="form-group">
                            {!! Form::select('smtp',$smtp_id,null,['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div  class="col-md-2" >
                        <div class="input-group">
                            {!! Form::select('imap',$imap_id,null,['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div  class="col-md-2" >
                        <div class="input-group">
                            {!! Form::select('country', $country_id,Input::old('country_origin'),['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div  class="col-md-2" >
                        <div class="input-group">
                            {!! Form::Select('status',array(''=>'Select Status','active'=>'Active','inactive'=>'Inactive','cancel'=>'Cancel'),Input::old('status'),['class'=>'form-control ']) !!}
                        </div>
                    </div>
                    {{--<div  class="col-md-1" >
                        <div class="input-group">
                            {!! Form::select('schedule', $schedule_id,Input::old('schedule'),['class' => 'form-control','required']) !!}
                        </div>
                    </div>--}}
                    <div class="col-md-1">
                       <button class="btn btn-info btn-flat" type="submit" >Search</button>
                    </div>
                    {!! Form::close() !!}


                    <table  class="display table table-bordered table-striped" id="data-table-example">
                        <thead>
                        <tr>
                            <th>Email</th>
                            <th>Smtp</th>
                            <th>Imap</th>
                            <th>Country</th>
                            <th>Price</th>
                            <th>Schedule</th>
                            <th>Execution Time</th>
                            <th>Status</th>
                            <th>Lead</th>
                            <th>Invoice</th>
                            <th>Action </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($popping_emails as $values)
                            <tr class="gradeX">
                                <td>{{ isset($values->email)?$values->email:''  }}</td>
                                <td>{{ isset($values->relSmtp->name)?$values->relSmtp->name:'' }}</td>
                                <td>{{ isset($values->relImap->name)?$values->relImap->name:'' }}</td>
                                <td>{{ isset($values->country_origin)?$values->relCountry->title:'' }}</td>
                                <td>{{ isset($values->price)?$values->price:'' }}</td>
                                <td>
                                    @if(isset($values->relSchedule->day))
                                        Day-{{ $values->relSchedule->day }}
                                        Time-{{ $values->relSchedule->time }}
                                    @endif
                                </td>
                                <td>{{ isset($values->execution_time)?$values->execution_time:'' }}</td>
                                <td>{{ isset($values->status)?$values->status:'' }}</td>
                                <td>
                                    <a href="{{ URL::to('admin/lead/'.$values->id) }}" class="btn btn-primary btn-xs">Lead</a>

                                </td>
                                <td>
                                    <a href="{{ URL::to('admin/invoice/'.$values->id) }}" class="btn btn-primary btn-xs">Invoice</a>
                                </td>
                                <td>
                                    <a href="{{ url('admin/popping-email/show', $values->id) }}" class="btn btn-info btn-xs" data-toggle="modal" data-target="#etsbModal" title="Popping Email View"><i class="icon-eye-open"></i></a>
                                    <a href="{{ url('admin/popping-email/edit', $values->id) }}" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#etsbModal" title="Popping Email Edit"><i class="icon-edit"></i></a>
                                    {{--<a href="{{ url('admin/popping-email/delete', $values->id) }}" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure to Delete?')" title="Popping Email Delete"><i class="icon-trash"></i></a>--}}
                                </td>
                            </tr>
                        @endforeach
                    </table>

                    <span class="pull-right">{!! $popping_emails->appends($_REQUEST) !!} </span>

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
                <h4 class="modal-title">Add Popping Email</h4>
            </div>
            <div class="modal-body">
                {!! Form::open(['url' => 'admin/popping-email-store']) !!}
                @include('admin::popping_email._form')
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
<!-- Modal for delete -->
<div class="modal fade " id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Confirm Delete</h4>
            </div>
            <div class="modal-body">
                <strong>Are you sure to delete?</strong>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a href="#" class="btn btn-danger danger">Delete</a>

            </div>
        </div>
    </div>
</div>





<!--script for this page only-->
@if($errors->any())
    <script type="text/javascript">
        $(function(){
            $("#addData").modal('show');
        });
    </script>
@endif

@stop