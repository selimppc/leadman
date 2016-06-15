@if($errors->any())
    <ul class="alert alert-danger">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif
<div class="form-group">
    {!! Form::label('day', 'Day:', ['class' => 'control-label']) !!}
    {!! Form::input('number', 'day', null, ['id'=>'day', 'class' => 'form-control', 'required'=>'required','min'=>1]) !!}

</div>
<div class="form-group">
    {!! Form::label('time', 'Time:', ['class' => 'control-label']) !!}
    {!! Form::input('time', 'time', null, ['id'=>'time', 'class' => 'form-control', 'minlength'=>'2', 'required'=>'required']) !!}

</div>

<p> &nbsp; </p>

<a href="{{ URL::to('admin/schedule') }}"  class="btn btn-default" type="button"> Close </a>

{!! Form::submit('Submit', ['class' => 'btn btn-success']) !!}