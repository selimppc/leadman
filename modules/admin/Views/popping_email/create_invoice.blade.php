<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
             <a href="{{ URL::to('admin/popping-email')}}" class="btn btn-default pull-right" type="button"> &times;</a>

            <h4 class="modal-title">Create Invoice for <b>{{isset($pop_email->email)?$pop_email->email:null}}</b></h4>
        </div>
        <div class="modal-body">

            {!! Form::model(isset($pop_email)?$pop_email:null, ['method' => 'PATCH', 'url'=> ['proceed_create_invoice']]) !!}

            {!! Form::hidden('user_id', isset($pop_email->id)?$pop_email->id:null ) !!}

            <p>User Email : <b>{{isset($pop_email->email)?$pop_email->email:null}}</b></p>

            <div class="form-group">
                {!! Form::label('comments', 'Comments:', ['class' => 'control-label']) !!}
                <small>(optional) </small>
                {!! Form::textarea('comments', null, ['class' => 'form-control', 'rows'=>6]) !!}
            </div>



            <a href="{{ URL::to('admin/popping-email')}}" class="btn btn-default" type="button"> Close </a>
            {!! Form::submit('Submit', ['class' => 'btn btn-success']) !!}

            {!! Form::close() !!}

            <p> &nbsp; </p>
        </div>
    </div>
</div>