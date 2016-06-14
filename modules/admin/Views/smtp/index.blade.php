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
                SMTP Management
                <a class="btn-sm btn-success pull-right paste-blue-button-bg" data-toggle="modal" href="#addData">
                    <strong>Add Smtp</strong>
                </a>
            </header>


            <div class="panel-body">
                <div class="adv-table">
                    <table  class="display table table-bordered table-striped" id="data-table-example">
                        <thead>
                        <tr>
                            <th> ID </th>
                            <th> Name </th>
                            <th> User Name </th>
                            <th> Host </th>
                            <th> Port </th>
                            <th> Smtp </th>
                            <th> Cpanel Port </th>
                            <th> Action </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($smtp as $values)
                            <tr class="gradeX">
                                <td>{{$values->id}}</td>
                                <td>{{$values->name}}</td>
                                <td>{{$values->server_username}}</td>
                                <td>{{$values->host}}</td>
                                <td>{{$values->port}}</td>
                                <td>{{$values->smtp}}</td>
                                <td>{{$values->c_port}}</td>
                                <td>
                                <a href="{{ url('admin/smtp/edit', $values->id) }}" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#etsbModal" title="Smtp Edit"><i class="icon-edit"></i></a>
                                <a href="{{ url('admin/smtp/delete', $values->id) }}" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure to delete')" title="Smtp Delete"><i class="icon-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </section>
    </div>
</div>
<!-- page end-->


<!-- addData -->
<div class="modal fade in" id="addData" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Add SMTP</h4>
            </div>
            <div class="modal-body">
                {!! Form::open(['url' => 'admin/smtp']) !!}
                @include('admin::smtp._form')
                {!! Form::close() !!}

            </div>

        </div>
    </div>
</div>
<!-- modal -->


<!-- Modal for edit -->
<div class="modal fade" id="etsbModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
</div>

<!-- TEST Area -->

<div id="myModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Subscribe our Newsletter</h4>
            </div>
            <div class="modal-body">
                <p>Welcome to modal </p>
                <p> Thank you</p>
            </div>
        </div>
    </div>
</div>

@if($errors->any())
    <script type="text/javascript">
        $(function(){
            $("#addData").modal('show');
        });
   </script>
@endif
@if(Session::has('flash_message_error'))
    <script type="text/javascript">
        $(function(){
            $("#addData").modal('show');
        });
    </script>
@endif
{{-- radio button check for pulic and private domain --}}
<script type="text/javascript">
    function check() {
        if (document.getElementById("private-domain").checked == true) {
            //alert("You have selected private-domain");
            var div = document.getElementById("check-button");
            var inputAll = div.getElementsByTagName('input');
            for(var i = 0; i < inputAll.length; i++) {
                inputAll[i].required = true;
            }
            //inputAll.required ="true";
            div.style.display = 'block';
        }
        if (document.getElementById("public-domain").checked == true) {
            //alert("You have selected private-domain");
            var div = document.getElementById("check-button");
            var inputAll = div.getElementsByTagName('input');
            for(var i = 0; i < inputAll.length; i++) {
                inputAll[i].required = false;
            }
            //inputAll.required ="false";
            //div.parentNode.removeChild(div);
            div.style.display = 'none';
        }
    }
</script>

@stop