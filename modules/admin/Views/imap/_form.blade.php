@if($errors->any())
    <ul class="alert alert-danger">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif
@if(Session::has('error'))
    <div class="alert alert-danger">
        <p>{{ Session::get('error') }}</p>
    </div>
@endif

<div class="form-group">
    {!! Form::label('name', 'Name:', ['class' => 'control-label']) !!}
    <small class="required">(Required)</small>
    {!! Form::text('name', null, ['class' => 'form-control' ,'required']) !!}
</div>

<div class="form-group">
    {!! Form::label('host', 'Host:', ['class' => 'control-label']) !!}
    <small class="required">(Required)</small>
    <i>(ex: imap.example.com)</i>
    {!! Form::input('url','host', null, ['class' => 'form-control','id'=>'host','data-fv-uri'=>'true','required']) !!}
    <p id="delay-error"></p>
</div>


<div class="form-group">
    {!! Form::label('port', 'Port:', ['class' => 'control-label']) !!}
    <small class="required">(Required)</small>
    {!! Form::input('number','port', null,  ['class' => 'form-control','required']) !!}
</div>

<p> &nbsp; </p>

<div class="form-group">
    <a href="" class="btn btn-default" type="button"> Close </a>
    {!! Form::submit('Submit', ['class' => 'btn btn-success']) !!}
</div>

@include('admin::imap._script')

