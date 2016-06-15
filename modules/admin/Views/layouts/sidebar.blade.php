<li class="sub-menu">
    <a class="active" href="{{--{{ URL::route('user.dashboard') }}--}}">
        <i class="icon-dashboard"></i>
        <span>Dashboard</span>
    </a>
</li>

<li class="sub-menu">
    <a href='{{URL::to('admin/imap')}}'>
        <i class="icon-laptop"></i>
        <span>Imap</span>
    </a>
</li>

<li class="sub-menu">
    <a href='{{URL::to('admin/smtp')}}'>
        <i class="icon-dashboard"></i>
        <span>Smtp</span>
    </a>
</li>

<li class="sub-menu">
    <a href='{{URL::to('admin/popping-email')}}'>
        <i class="icon-envelope"></i>
        <span>Popping Email</span>
    </a>
</li>

<li class="sub-menu">
    <a href={{--{{URL::to('article/index')}}--}}>
        <i class="icon-paste"></i>
        <span>Lead</span>
    </a>
</li>

<li class="sub-menu">
    <a href='{{URL::to('admin/schedule')}}'>
        <i class="icon-external-link"></i>
        <span>Schedule</span>
    </a>
</li>


<li class="sub-menu">
    <a href={{--{{URL::to('article/index')}}--}}>
        <i class="icon-jpy"></i>
        <span>Invoice Head</span>
    </a>
</li>

<li class="sub-menu">
    <a href='{{URL::to('admin/filter')}}'>
        <i class="icon-filter"></i>
        <span>Filter</span>
    </a>
</li>

<li class="sub-menu">
    <a href={{--{{URL::to('article/index')}}--}}>
        <i class="icon-comment-alt"></i>
        <span>Country</span>
    </a>
</li>

<li class="sub-menu">
    <a href="javascript:;">
        <i class="fa fa-user"></i>
        <span>User</span>
    </a>
    <ul class="sub">
        <li class="active"><a href="{{route('user-profile')}}"> Profile</a></li>
        <li><a href="{{route('user-list')}}">User List</a></li>
        <li><a href="{{route('index-role-user')}}">Role User</a></li>
        <li><a href="{{route('index-permission-role')}}"><span class="mm-text">Permission Role</span></a></li>
        <li><a href="{{route('user-activity')}}"><span class="mm-text">User Activity </span></a></li>
        <li><a href="{{route('menu-panel')}}"><span class="mm-text">Menu Panel </span></a></li>
        <li><a href="{{route('menu-panel')}}"><span class="mm-text">Department </span></a></li>
    </ul>
</li>

<li class="sub-menu">
    <a href={{URL::to('admin/central-settings')}}>
        <i class="icon-cog"></i>
        <span>Settings</span>
    </a>
</li>



@if(\Illuminate\Support\Facades\Session::has('sidebar_menu_user----'))
    <?php $side_bar_menu = \Illuminate\Support\Facades\Session::get('sidebar_menu_user'); ?>

    @if($side_bar_menu) {{--Session['sidebar_menu_user']--}}
    @foreach($side_bar_menu as $module) {{--Every module on sidebar menu--}}
    @if(count($module['sub-menu'])>0) {{--Session['sidebar_menu_user']--}}
    @foreach($module['sub-menu'] as $sub_module) {{--Sub menu on every module--}}
    <li>
        <a tabindex="-1" href="{{URL::to($sub_module['route'])}}">
            <i class="{{@$sub_module['icon_code']}}"> </i>
            <span class="mm-text">{{$sub_module['menu_name']}}</span>
        </a>
        @if(count($sub_module['sub-menu'])>0)
            <ul class="nav nav-second-level collapse">
                @foreach($sub_module['sub-menu'] as $sub_sub_module)
                    <li>
                        <a tabindex="-1" href="{{URL::to($sub_sub_module['route'])}}">
                            <i class="{{@$sub_sub_module['icon_code']}}"> </i>
                            <span class="mm-text">{{$sub_sub_module['menu_name']}}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif
    </li>

    @endforeach
    @endif
    @endforeach
    @endif
@endif








