<script type="text/javascript" src="{{ URL::asset('assets/js/multiselect.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/multiselect.min.js') }}"></script>


@if(isset($role_value))
    {!! Form::hidden('role_id',$role_value) !!}
@endif
{!! Form::hidden('status','active') !!}


<div class="row">
    <div class="col-sm-5">
        <strong class="text-center">Unassigned Permission List</strong>
        <select id="optgroup" class="form-control" size="20" multiple="multiple">
            @if(isset($not_exists_permission))
                @foreach($not_exists_permission as $key=>$value)
                       <option value="{{$key}}">{{$value}}</option>
                @endforeach
            @endif
        </select>
    </div>

    <div class="form-group col-sm-2 padding-top" style="padding-top:10%">
        <button type="button" id="optgroup_rightAll" class="btn btn-block"><i class="glyphicon glyphicon-forward"></i></button>
        <button type="button" id="optgroup_rightSelected" class="btn btn-block"><i class="glyphicon glyphicon-chevron-right"></i></button>
        <button type="button" id="optgroup_leftSelected" class="btn btn-block"><i class="glyphicon glyphicon-chevron-left"></i></button>
        <button type="button" id="optgroup_leftAll" class="btn btn-block"><i class="glyphicon glyphicon-backward"></i></button>
    </div>

    <div class="form-group col-sm-5">
        <strong class="text-center">Assigned Permission List</strong>
        <select name="permission_id[]" id="optgroup_to" class="check form-control" size="20" multiple="multiple">
            @if(isset($not_exists_permission))
                @foreach($exists_permission as $keys=>$values)
                    <option value="{{$keys}}">{{$values}}</option>
                @endforeach
            @endif
        </select>
        <span id='check-message' class="required"></span>
    </div>
</div>

<div class="form-margin-btn" style="margin-left:70%">
    {!! Form::submit('Save changes', ['class' => 'btn btn-primary','data-placement'=>'top','data-content'=>'click save changes button for save information','id'=>'check-empty']) !!}
    <a href="{{route('index-permission-role')}}" class=" btn btn-default" data-placement="top" data-content="click close button for close this entry form" onclick="close_modal();">Close</a>
</div>

<p> &nbsp; </p>


<script type="text/javascript">
    jQuery(document).ready(function($) {
        $("#optgroup").multiselect({
            search: {
                left: '<input type="text" name="q" class="form-control" placeholder="Search..." />',
                right: '<input type="text" name="q" class="form-control" placeholder="Search..." />',
            }
        });
    });



</script>

<script>
    /*$("#check-empty").click(function(){

        var permission = $('select[id=optgroup_to]').val();
        if (permission!=undefined && permission.length > 0) {
            alert('gh');
//            $('#check-message').html('please move at least one permission here and then submit.');
//            document.getElementById("check-empty").disabled = true;
//            return true;
            $('#check-message').html('');
           document.getElementById("check-empty").disabled = true;
            //return false;
        }else{
            alert('333');
            $('#check-message').html('please move at least one permission here and then submit.');
           document.getElementById("check-empty").disabled = false;
            //return false;
        }
    });*/
</script>












