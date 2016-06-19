@if($errors->any())
    <ul class="alert alert-danger">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<div class="form-group">
    {!! Form::label('name', 'Name:', ['class' => 'control-label']) !!}
    <small class="required">(Required)</small>
    {!! Form::text('name', null, ['id'=>'name', 'class' => 'form-control', 'minlength'=>'2', 'required'=>'required']) !!}

</div>
<div class="form-group">
    {!! Form::label('filtercol', 'Filter Column:', ['class' => 'control-label']) !!}
    <small class="required">(Required)</small>
    {!! Form::text('filtercol', null, ['id'=>'filtercol', 'class' => 'form-control', 'minlength'=>'2', 'required'=>'required']) !!}

</div>

<p> &nbsp; </p>

<a href="{{ URL::to('admin/filter') }}"  class="btn btn-default" type="button"> Close </a>

{!! Form::submit('Submit', ['class' => 'btn btn-success']) !!}