<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            {{-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>--}}
            <h4 class="modal-title">Edit Schedule</h4>
        </div>
        <div class="modal-body">

            {!! Form::model($data, ['method' => 'PATCH', 'url'=> ['admin/schedule', $data->id]]) !!}
            @include('admin::schedule._form')
            {!! Form::close() !!}

        </div>
    </div>
</div>