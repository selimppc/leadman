@if($errors->any())
    <ul class="alert alert-danger">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif


<div class="form-group">
    {!! Form::label('title', ucfirst($data->title), ['class' => 'control-label']) !!}
    {!! Form::text('status', null, ['class' => 'form-control', 'required'=>'required']) !!}
</div>

<p> &nbsp; </p>

<a href="{{ URL::to('admin/central-settings')}}" class="btn btn-default" type="button"> Close </a>
{!! Form::submit('Submit', ['class' => 'btn btn-success']) !!}