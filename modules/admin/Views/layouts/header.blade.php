<div class="sidebar-toggle-box">
    <div data-original-title="Toggle Navigation" data-placement="right" class="icon-reorder tooltips"></div>
</div>
<!--logo start-->
<a href="{{--{{ URL::route('home-dashboard') }}--}}" class="logo">Lead<span>Man</span></a>
<small> Time: <?php echo date('Y-m-d H:i:s'); ?> </small>
<!--logo end-->
<div class="nav notify-row" id="top_menu">
    <!--  notification start -->
    <ul class="nav top-menu">
        <!-- settings start -->
        <li class="dropdown">
            {{--Central Settings--}}
        </li>
    </ul>
    <!--  notification end -->
</div>
<div class="top-nav ">
    <!--search & user info start-->
    <ul class="nav pull-right top-menu">
        <li>
            <input type="text" class="form-control search" placeholder="Search">
        </li>
        <li class="center"><p><b> {{--{!! isset(Auth::user()->first_name) ?Auth::user()->first_name:'' !!}--}} </b></p></li>
        <!-- user login dropdown start-->
        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                {{--{!! Html::image('/etsb/img/avatar2.png', 'title', array()) !!}--}}
                {{--<span class="username">Jhon Doue</span>--}}
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu extended logout">
                <div class="log-arrow-up"></div>
                {{--<li><a href="#"><i class=" icon-suitcase"></i>Profile</a></li>
                <li><a href="#"><i class="icon-cog"></i> Setting</a></li>
                  <li><a href="#"><i class="icon-bell-alt"></i> Notification</a></li>--}}

                {{--@if(isset(Auth::user()->id))
                    <li><a href="#"><i ></i></a></li>
                    <li><a href="{{ URL::to('user/profile-info') }}"><i class="icon-cog"></i>Profile</a></li>
                    <li><a href="#"><i ></i> </a></li>
                    <li><a href={{ route('user.logout') }}><i class="icon-key"></i> Log Out</a></li>
                @else
                    <li><a href={{ route('user-login') }}><i class="icon-key"></i> Sign In</a></li>
                @endif--}}
            </ul>
        </li>
        <!-- user login dropdown end -->
    </ul>
    <!--search & user info end-->
</div>

<style>
    .center{
        padding-top: 10px;
    }
</style>