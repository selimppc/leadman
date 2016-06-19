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
    {!! Form::label('name', 'SMTP Name', ['class' => 'control-label']) !!}
    <small class="required">(Required)</small><br>
    {{--<i>(for gmail, ymail user email/username | for domain put server username)</i>--}}
    {!! Form::text('name', null, ['class' => 'form-control','required']) !!}
</div>
<div class="form-group">
    {!! Form::label('server_username', 'Server User Name', ['class' => 'control-label']) !!}
    <small class="required">(Required)</small><br>
    {{--<i>(for gmail, ymail user email/username | for domain put server username)</i>--}}
    {!! Form::text('server_username', null, ['class' => 'form-control','required']) !!}
</div>

<div class="form-group">
    {!! Form::label('server_password', 'Server Password', ['class' => 'control-label']) !!}
    @if(!isset($smtp_data))
        <small class="required">(Required)</small><br>
    @endif
    {{--<i>(for gmail, ymail, mail put email-password | for domain put server password)</i>--}}
    @if(isset($smtp_data))
    {!! Form::password('server_password', array('class'=>'form-control','id'=>'password','name'=>'server_password')) !!}
    @else
        {!! Form::password('server_password', array('class'=>'form-control','id'=>'password','name'=>'server_password','required')) !!}
    @endif

</div>
<div class="form-group">
    {!! Form::label('host', 'Host', ['class' => 'control-label']) !!}
    <small class="required">(Required)</small><br>
    <i>(for private domain ex:'domain.com' | for public domain ex:'smtp.domain.com')</i>
    {!! Form::text('host', null, ['class' => 'form-control', 'placeholder'=>'domain.com','required']) !!}
</div>
<div class="form-group">
    {!! Form::label('port', 'Port:', ['class' => 'control-label']) !!}
    <small class="required">(Required)</small>
    {!! Form::input('number','port', null,  ['class' => 'form-control','required']) !!}
</div>
<div class="form-group">
    {!! Form::label('smtp', 'SMTP', ['class' => 'control-label']) !!}
    {{--<i>(for gmail, ymail user email/username | for domain put server username)</i>--}}
    {!! Form::text('smtp', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('c_port', 'Cpanel Port:', ['class' => 'control-label']) !!}
    <small class="required">(Required)</small>
    {!! Form::input('number','c_port', null, ['class' => 'form-control','required']) !!}
</div>

<p> &nbsp; </p>

<div class="form-group">
    <a href="" class="btn btn-default" type="button"> Close </a>
    {!! Form::submit('Submit', ['class' => 'btn btn-success']) !!}
</div>

