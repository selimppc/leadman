<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
           {{-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>--}}
            <h4 class="modal-title">Popping Email Edit</h4>
        </div>
        <div class="modal-body">

            {!! Form::model($popping_email, ['method' => 'PATCH', 'url'=> ['admin/popping-email', $popping_email->id]]) !!}
                {!! Form::hidden('popping_email_id', $popping_email->id ) !!}
                @include('admin::popping_email._form')
            {!! Form::close() !!}

        </div>
    </div>
</div>