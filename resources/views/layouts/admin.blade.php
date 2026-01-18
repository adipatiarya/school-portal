<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title')</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="{{asset('admin/assets/css/bootstrap.min.css')}}">
    <!-- Material Design Bootstrap -->
    <link rel="stylesheet" href="{{asset('admin/assets/css/mdb.min.css')}}">
    
    <style>
       .collapsible li .collapsible-header.active {
         /* background-color: rgba(0,0,0, .05) !important; */
       }
       .collapsible li .collapsible-body {
            /* background-color: #f8f9fa !important; */

       }
    </style>


    @yield('custom-css')
</head>

<body class="fixed-sn white-skin">

    <!--Main Navigation-->
    <header>

        <!-- Sidebar navigation -->
        <div id="slide-out" class="side-nav sn-bg-4 fixed">
            <ul class="custom-scrollbar">
            <!-- Logo -->
            <li class="logo-sn waves-effect">
                <div class="text-center">
                    <a href="#" class="pl-0"><img src="https://mdbootstrap.com/img/logo/mdb-transaprent-noshadows.png" class=""></a>
                </div>
            </li>
            <!--/. Logo -->

            <!--Search Form-->
            <li>
                <form class="search-form" role="search">
                    <div class="form-group md-form mt-0 pt-1 waves-light">
                        <input type="text" class="form-control" placeholder="Search">
                    </div>
                </form>
            </li>
            <!--/.Search Form-->
            <!-- Side navigation links -->
            <li>
                <ul class="collapsible collapsible-accordion">
                    <li><a href="{{route('admin.dashboard')}}" class="collapsible-header waves-effect {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"><i class="fa fa-tachometer"></i> Dashboard</a></li>
                    <li><a class="collapsible-header waves-effect arrow-r  {{ request()->routeIs('admin.posts.*') ? 'active' : '' }}"><i class="fa fa-file"></i> Posts<i class="fa fa-angle-down rotate-icon"></i></a>
                        <div class="collapsible-body">
                            <ul>
                                <li><a href="{{route('admin.posts.index')}}" class="waves-effect" style="{{ request()->routeIs('admin.posts.index') ? 'color:#4285F4' : '' }}">List</a></li>
                                <li><a href="{{route('admin.posts.create')}}" class="waves-effect" style="{{ request()->routeIs('admin.posts.create') ? 'color:#4285F4' : '' }}">Add new</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </li>
            <!--/. Side navigation links -->
            </ul>
            <div class="sidenav-bg mask-strong"></div>
        </div>
        <!--/. Sidebar navigation -->

        <!-- Navbar -->
        <nav class="navbar fixed-top navbar-expand-lg scrolling-navbar double-nav">
            <!-- SideNav slide-out button -->
            <div class="float-left">
                <a href="#" data-activates="slide-out" class="button-collapse black-text"><i class="fa fa-bars"></i></a>
            </div>
            <!-- Breadcrumb-->
            <div class="breadcrumb-dn mr-auto">
                <p>Material Design for Bootstrap</p>
            </div>

            <!--Navbar links-->
            <ul class="nav navbar-nav nav-flex-icons ml-auto">

                <!-- Dropdown -->
                <li class="nav-item dropdown notifications-nav">
                    <a class="nav-link dropdown-toggle waves-effect" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <span class="badge red">3</span> <i class="fa fa-bell"></i>
                        <span class="d-none d-md-inline-block">Notifications</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="#">
                            <i class="fa fa-money mr-2" aria-hidden="true"></i>
                            <span>New order received</span>
                            <span class="float-right"><i class="fa fa-clock-o" aria-hidden="true"></i> 13 min</span>
                        </a>
                        <a class="dropdown-item" href="#">
                            <i class="fa fa-money mr-2" aria-hidden="true"></i>
                            <span>New order received</span>
                            <span class="float-right"><i class="fa fa-clock-o" aria-hidden="true"></i> 33 min</span>
                        </a>
                        <a class="dropdown-item" href="#">
                            <i class="fa fa-line-chart mr-2" aria-hidden="true"></i>
                            <span>Your campaign is about to end</span>
                            <span class="float-right"><i class="fa fa-clock-o" aria-hidden="true"></i> 53 min</span>
                        </a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link waves-effect"><i class="fa fa-envelope"></i> <span class="clearfix d-none d-sm-inline-block">Contact</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link waves-effect"><i class="fa fa-comments-o"></i> <span class="clearfix d-none d-sm-inline-block">Support</span></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle waves-effect" href="#" id="userDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-user"></i> <span class="clearfix d-none d-sm-inline-block">Profile</span></a>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="#">Log Out</a>
                        <a class="dropdown-item" href="#">My account</a>
                    </div>
                </li>

            </ul>
            <!--/Navbar links-->
        </nav>
        <!-- /.Navbar -->

    </header>
    <!--Main Navigation-->

    <!--Main layout-->
    <main>
        <div class="container-fluid">

            @yield('content')

        </div>
    </main>
    <!--Main layout-->

    <!--Footer-->
    <footer class="page-footer pt-0 mt-5">

        <!--Copyright-->
        <div class="footer-copyright py-3 text-center">
              <div class="container-fluid">
                 © 2018 Copyright: <a href="https://mdbootstrap.com/bootstrap-tutorial/" target="_blank"> MDBootstrap.com </a>

            </div>
        </div>
        <!--/.Copyright-->

    </footer>
    <!--/.Footer-->

    @yield('modal')



    <!-- SCRIPTS -->
    <!-- JQuery -->
    <script src="{{asset('admin/assets/js/jquery-3.3.1.min.js')}}"></script>
    <!-- Bootstrap tooltips -->
    <script src="{{asset('admin/assets/js/popper.min.js')}}"></script>
    <!-- Bootstrap core JavaScript -->
    <script src="{{asset('admin/assets/js/bootstrap.js')}}"></script>
    <!-- MDB core JavaScript -->
    <script src="{{asset('admin/assets/js/mdb.min.js')}}"></script>
    <!--Custom scripts-->
    <script>
        // SideNav Initialization
        $(".button-collapse").sideNav();

        var container = document.querySelector('.custom-scrollbar');
        Ps.initialize(container, {
            wheelSpeed: 2,
            wheelPropagation: true,
            minScrollbarLength: 20
        });
    </script>
    @yield('custom-js')
</body>

</html>