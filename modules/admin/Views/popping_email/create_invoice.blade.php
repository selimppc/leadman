<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
             <a href="{{ URL::to('admin/popping-email')}}" class="btn btn-default pull-right" type="button"> &times;</a>

            <h4 class="modal-title">Create Invoice for <b>{{$pop_email->email}}</b></h4>
        </div>
        <div class="modal-body">

            {!! Form::model($pop_email, ['method' => 'PATCH', 'url'=> ['proceed_create_invoice']]) !!}

            {!! Form::hidden('popping_email_id', $pop_email->id ) !!}

            <p>Popping Email : <b>{{$pop_email->email}}</b></p>

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