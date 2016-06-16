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
                <a class="btn-sm btn-success pull-right paste-blue-button-bg" data-toggle="modal" href="#addData">
                    <b>Add Popping Email</b>
                </a>
            </header>

            <div class="panel-body">
                <div class="adv-table">

                    {{-------------- Filter :Starts -------------------------------------------}}
                    {!! Form::model($_REQUEST,['url' => 'admin/popping-email','method'=>'get']) !!}
                    <div  class="col-lg-3 pull-left" >
                        <div class="input-group input-group-sm">
                            {!! Form::text('popmail_filter', null, ['id'=>'popmail_filter','placeholder'=>'Search by email','class' => 'form-control','required']) !!}
                            <span class="input-group-btn">
                               <button class="btn btn-info btn-flat" type="submit" >Search</button>
                            </span>
                        </div>
                    </div>
                    {!! Form::close() !!}


                    <table  class="display table table-bordered table-striped" id="data-table-example">
                        <thead>
                        <tr>
                            <th>Email</th>
                            <th>Smtp</th>
                            <th>Imap</th>
                            <th>Action </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($popping_emails as $values)
                            <tr class="gradeX">
                                <td>{{ isset($values->email)?$values->email:''  }}</td>
                                <td>{{ isset($values->relSmtp->name)?$values->relSmtp->name:'' }}</td>
                                <td>{{ isset($values->relImap->name)?$values->relImap->name:'' }}</td>
                                <td>
                                    <a href="{{ url('admin/popping-email/show', $values->id) }}" class="btn btn-info btn-xs" data-toggle="modal" data-target="#etsbModal" title="Popping Email View"><i class="icon-eye-open"></i></a>
                                    <a href="{{ url('admin/popping-email/edit', $values->id) }}" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#etsbModal" title="Popping Email Edit"><i class="icon-edit"></i></a>
                                    <a href="{{ url('admin/popping-email/delete', $values->id) }}" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure to Delete?')" title="Popping Email Delete"><i class="icon-trash"></i></a>
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
                {!! Form::open(['url' => 'admin/popping-email']) !!}
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