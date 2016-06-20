@if($errors->any())
    <ul class="alert alert-danger">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif
<div class="form-group">
    {!! Form::label('day', 'Day:', ['class' => 'control-label']) !!}
    <small class="required">(Required)</small>
    {!! Form::input('number', 'day', null, ['id'=>'number', 'class' => 'form-control', 'required'=>'required','min'=>0]) !!}

</div>
<div class="form-group">
    {!! Form::label('time', 'Time:', ['class' => 'control-label']) !!}
    <small class="required">(Required)</small>
    {!! Form::input('text', 'timee', null, ['class' => 'form-control', 'pattern'=>'^([01]?[0-9]{1}|2[0-3]{1}):[0-5]{1}[0-9]{1}$','data-fv-regexp-message'=>'The meeting time must be between 01:00 and 23:59', 'required'=>'required', 'placeholder'=>'23:00']) !!}
{{--    <input type="time" name="time" value="{{ Input::old('time') }}" class="form-control">--}}
    {{--placeholder="HH:mm"
    pattern="^(09|1[0-7]{1}):[0-5]{1}[0-9]{1}$"
    data-fv-regexp-message="The meeting time must be between 09:00 and 17:59"--}}
</div>

<p> &nbsp; </p>

<a href="{{ URL::to('admin/schedule') }}"  class="btn btn-default" type="button"> Close </a>

{!! Form::submit('Submit', ['class' => 'btn btn-success']) !!}

@include('admin::schedule._script')