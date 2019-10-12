<header class="main-header">
    <!-- Logo -->
    <a href="{{route('dashboard')}}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>A</b>LT</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Admin</b>LTE</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    {{--navbar-static-top--}}
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button" style="margin-right: auto" >
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav inline mr-5">
                @if(Auth::User())
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-user"></i>
                            <span class="hidden-xs">{{Auth::User()->name}}</span>
                        </a>
                        <ul class="dropdown-menu hover border-primary" style="width: 30px;border: 1px solid">
                            <li>
                                <a href="{{route('logout')}}" class="text-primary"><i class="fa fa-sign-out"></i> logout</a>
                            </li>
                        </ul>
                    </li>

                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-cog"></i>
                        </a>
                        <ul class="dropdown-menu hover border-primary" style="width: 30px;border: 1px solid">
                            <li>
                                <a href="{{route('change.password')}}" class="text-primary"><i class="fa fa-lock"></i> password change</a>
                            </li>
                        </ul>
                    </li>
                    @else
                    <li>
                        <a href="{{route('login')}}"><i class="fa fa-sign-in"></i> signIn</a>
                    </li>
                    @endif
            </ul>

        </div>
    </nav>
</header>