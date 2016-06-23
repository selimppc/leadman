@if($errors->any())
    <ul class="alert alert-danger">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif



    <div class="form-group">
        {!! Form::label('email', 'Email:', ['class' => 'control-label']) !!}
        {!! Form::email('email', null, ['id'=>'email', 'class' => 'form-control', 'required'=>'required']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('password', 'Password:', ['class' => 'control-label']) !!}
        {!! Form::password('password', array('class'=>'form-control','id'=>'password','name'=>'password')) !!}
    </div>

<div class="form-group">
    {!! Form::label('smtp_id', 'Smtp Name:', ['class' => 'control-label']) !!}
    {!! Form::select('smtp_id', $smtp_id,Input::old('smtp_id'),['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('imap_id', 'Imap Name:', ['class' => 'control-label']) !!}
    {!! Form::select('imap_id', $imap_id,Input::old('imap_id'),['class' => 'form-control','required']) !!}
</div>


@if(Session::get('role_title') != 'user')

<div class="form-group">
    {!! Form::label('schedule_id', 'Schedule Name:', ['class' => 'control-label']) !!}
    {!! Form::select('schedule_id', $schedule_id,Input::old('schedule_id'),['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('price', 'Price:', ['class' => 'control-label']) !!}
    {!! Form::text('price', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('keyword', 'Keyword:', ['class' => 'control-label']) !!}
    {!! Form::text('keyword', null, ['class' => 'form-control']) !!}
</div>

@endif

<div class="form-group">
    {!! Form::label('country_id', 'Origin Country Name:', ['class' => 'control-label']) !!}
    {!! Form::select('country_origin', $country_id,Input::old('country_origin'),['class' => 'form-control','required']) !!}
</div>

{{--<div class="form-group">
    {!! Form::label('status', 'Status:', ['class' => 'control-label']) !!}
    {!! Form::Select('status',array('active'=>'Active','inactive'=>'Inactive','cancel'=>'Cancel'),Input::old('status'),['class'=>'form-control ','required']) !!}
</div>--}}


<p> &nbsp; </p>

<a href="{{ URL::to('admin/popping-email')}}" class="btn btn-default" type="button"> Close </a>
{!! Form::submit('Submit', ['class' => 'btn btn-success']) !!}