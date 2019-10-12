<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{asset('dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <li class="">
                <a href="{{route('dashboard')}}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
            @if(Auth::User())
            @if(Auth::User()->hasRole('admin'))
                    <li class=" treeview">
                        <a href="#">
                            <i class="fa fa-user"></i> <span>User</span>
                            <span class="pull-right-container">
                              <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="active"><a href="{{route('new-user')}}"><i class="fa fa-plus-square"></i> Add User</a></li>
                            <li><a href="{{route('users')}}"><i class="fa fa-user-circle-o"></i> Users</a></li>
                        </ul>
                    </li>

            @endif
            @endif
            <li class=" treeview">
                <a href="#">
                    <i class="fa fa-key"></i> <span>Top Up</span>
                    <span class="pull-right-container">
                              <i class="fa fa-angle-left pull-right"></i>
                            </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="{{route('key')}}"><i class="fa fa-plus-circle"></i> keys</a></li>
                    <li><a href="{{route('key.print')}}"><i class="fa fa-key"></i> Top up</a></li>

                </ul>
            </li>
            <li class=" treeview">
                <a href="#">
                    <i class="fa fa-bolt"></i> <span>Meter</span>
                    <span class="pull-right-container">
                              <i class="fa fa-angle-left pull-right"></i>
                            </span>
                </a>
                <ul class="treeview-menu">
                    @if(Auth::User()->hasRole('admin'))
                    <li class="active"><a href="{{route('meter')}}"><i class="fa fa-plus-circle"></i> Add Meter</a></li>
                    <li class="active"><a href="{{route('meter.check')}}"><i class="fa fa-check-circle"></i> Check Meter</a></li>
                    @endif
                        {{--<li class="active"><a href="{{route('meter.user')}}"><i class="fa fa-arrow-circle-down"></i> Meter Info</a></li>--}}
                </ul>
            </li>
            <li class=" treeview">
                <a href="#">
                    <i class="fa fa-magic"></i> <span>Account</span>
                    <span class="pull-right-container">
                              <i class="fa fa-angle-left pull-right"></i>
                            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('account.info')}}"><i class="fa fa-info"></i> Account</a></li>
                </ul>
            </li>



        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
