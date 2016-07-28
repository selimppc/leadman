<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            {{-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>--}}
            <h4 class="modal-title">Setting Edit</h4>
        </div>
        <div class="modal-body">

            {!! Form::model($data, ['method' => 'PATCH', 'url'=> ['admin/central-settings-update', $data->id]]) !!}
            {!! Form::hidden('central_settings_id', $data->id ) !!}
            @include('admin::settings.central_settings._form')
            {!! Form::close() !!}

        </div>
    </div>
</div>