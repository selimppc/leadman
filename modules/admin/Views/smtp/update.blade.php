<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
           {{-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>--}}
            <h4 class="modal-title">SMTP Edit</h4>
        </div>
        <div class="modal-body">

            {!! Form::model($smtp_data, ['method' => 'PATCH', 'url'=> ['admin/smtp', $smtp_data->id]]) !!}
            @include('admin::smtp._form')
            {!! Form::close() !!}

        </div>
    </div>
</div>
