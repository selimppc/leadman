@if($errors->any())
    <ul class="alert alert-danger">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<style>
    .radio_button_check{
        cursor: pointer;
    }
</style>

<p>Choose you day type</p>

<div class="row">
    <div class="col-lg-3">
        <input type="radio" onclick="javascript:scheduleCheck();" name="radio" id="noOfDay" required/>
        <label class="radio_button_check" for="noOfDay"> No of day</label>
    </div>
    <div class="col-lg-3">
        <input type="radio" onclick="javascript:scheduleCheck();" name="radio" id="nameOfDay" required/>
        <label class="radio_button_check"  for="nameOfDay"> Week day</label>
    </div>
</div>


<div id="of-day" style="display:none">
    <div class="form-group">
        {!! Form::label('day', 'No of Day ', ['class' => 'control-label']) !!}
        <small class="required">(Required)</small><br>
        <small>Example: No of day = 1  </small><br>
        {!! Form::input('text', 'day', null, ['id'=>'num-day-name', 'class' => 'form-control', 'required'=>'required','min'=>0]) !!}

    </div>
</div>

<div id="day-name" style="display:none">
    <div class="form-group">
        {!! Form::label('day', ' Week day', ['class' => 'control-label']) !!}
        <small class="required">(Required)</small><br>
        <small>Example: Week day = saturday (small letter) </small><br>
        {!! Form::select('day', $week_days, null, ['id'=>'new-day-name', 'class' => 'form-control', 'required'=>'required']) !!}

    </div>
</div>


<script type="text/javascript">

    function scheduleCheck() {
        if (document.getElementById('noOfDay').checked) {
            document.getElementById('of-day').style.display = 'block';
            document.getElementById('day-name').style.display = 'none';
            $("#new-day-name").prop('disabled', true);
            $("#num-day-name").prop('disabled', false);
        }
        if (document.getElementById('nameOfDay').checked) {
            document.getElementById('day-name').style.display = 'block';
            document.getElementById('of-day').style.display = 'none';
            $("#new-day-name").prop('disabled', false);
            $("#num-day-name").prop('disabled', true);
        }
    }

</script>

{{--<div class="form-group">
    {!! Form::label('day', 'No of Day / Week day', ['class' => 'control-label']) !!}
    <small class="required">(Required)</small><br>
    <small>Example: No of day = 1 || Week day = saturday (small letter) </small>
    {!! Form::input('text', 'day', null, [ 'class' => 'form-control', 'required'=>'required','min'=>0, 'placeholder'=> "example 1 or saturday "]) !!}

</div>--}}
<div class="form-group">
    {!! Form::label('time', 'Time:', ['class' => 'control-label']) !!}
    <small class="required">(Required)</small>
    {!! Form::input('text', 'timee', null, ['class' => 'form-control', 'pattern'=>'^([01]?[0-9]{1}|2[0-3]{1}):[0-5]{1}[0-9]{1}$','data-fv-regexp-message'=>'The meeting time must be between 01:00 and 23:59', 'required'=>'required', 'placeholder'=>'23:00']) !!}
</div>



<a href="{{ URL::to('admin/schedule') }}"  class="btn btn-default" type="button"> Close </a>

{!! Form::submit('Submit', ['class' => 'btn btn-success']) !!}

@include('admin::schedule._script')