
<header class="app-header navbar">
        <button class="navbar-toggler mobile-sidebar-toggler d-lg-none" type="button">☰</button>
        <a class="navbar-brand" href="/"></a>
        @if (Auth::guest())
        @else
        <ul class="nav navbar-nav d-md-down-none">
            <li class="nav-item">
                {{-- <a class="nav-link navbar-toggler sidebar-toggler" href="#">☰</a> --}}
            </li>

            <li class="nav-item px-3">
                <a class="nav-link" href="/dash">Dashboard</a>
            </li>
            {{-- <li class="nav-item px-3">
                <a class="nav-link" href="#">Orders</a>
            </li> --}}
            <li class="nav-item px-3">
                <a class="nav-link" href="/product">Products</a>
            </li>
        </ul>
        @endif
        <ul class="nav navbar-nav ml-auto">

            {{-- <li class="nav-item d-md-down-none">
                <a class="nav-link" href="#"><i class="icon-list"></i></a>
            </li> --}}
            {{-- <li class="nav-item d-md-down-none">
                <a class="nav-link" href="#"><i class="icon-location-pin"></i></a>
            </li> --}}
               @if (Auth::guest())
                     <li class="nav-item px-3">
                        <a class="nav-link" href="/login">Login</a>
                    </li>
               @else
                 <li class="nav-item d-md-down-none">
                   <input type="hidden" name="cartcount" v-model="cart">
                <a class="nav-link" href="/cart"><i class="icon-basket"></i><span class="badge badge-pill badge-danger" id="cartcount">@{{ cart }}</span></a>
                 </li>
                 <li class="nav-item d-md-down-none">
                <a class="nav-link" href="#"><i class="icon-bell"></i><span class="badge badge-pill badge-danger">5</span></a>
                 </li>

                      <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <img src="{{asset('img/avatars/'.Auth::user()->avatar) }}" class="img-avatar" alt="admin@bootstrapmaster.com">
                    <span class="d-md-down-none">{{Auth::user()->name}}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">

                    <div class="dropdown-header text-center">
                        <strong>Account</strong>
                    </div>

                    {{-- <a class="dropdown-item" href="#"><i class="fa fa-bell-o"></i> Updates<span class="badge badge-info">42</span></a> --}}
                    <a class="dropdown-item" href="#"><i class="fa fa-envelope-o"></i> Messages<span class="badge badge-success">42</span></a>
                    <a class="dropdown-item" href="#"><i class="fa fa-tasks"></i> Tasks<span class="badge badge-danger">42</span></a>
                    {{-- <a class="dropdown-item" href="#"><i class="fa fa-comments"></i> Comments<span class="badge badge-warning">42</span></a> --}}

                    {{-- <div class="dropdown-header text-center">
                        <strong>Settings</strong>
                    </div> --}}

                    <a class="dropdown-item" href="/profile"><i class="fa fa-user"></i> Profile</a>
                    {{-- <a class="dropdown-item" href="#"><i class="fa fa-wrench"></i> Settings</a> --}}
                    <a class="dropdown-item" href="#"><i class="fa fa-usd"></i> Cash : {{ number_format(Auth::user()->cash,2)}} Baht</a>
                    {{-- <a class="dropdown-item" href="#"><i class="fa fa-file"></i> Projects<span class="badge badge-primary">42</span></a> --}}
                    <div class="divider"></div>
                    <a class="dropdown-item" href="#"><i class="fa fa-shield"></i> Level : {{ Auth::user()->level }}</a>
                    <a class="dropdown-item" href="/logout"><i class="fa fa-lock"></i> Logout</a>
                </div>
            </li>

               @endif



        </ul>
    </header>


{{-- <nav class="navbar navbar-default navbar-static-top">


                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>
                     @if (Auth::guest())
                         <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>
                        @else
                            <ul class="nav navbar-nav">
                             <li><a href="/scrap">Get Data </a></li>
                                <li><a href="/mylist">My Item </a></li>
                             </ul>
                        @endif

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="/login">Login</a></li>

                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="/logout"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="/logout" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav> --}}
