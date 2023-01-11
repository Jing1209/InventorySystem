<!DOCTYPE html>
<!-- Created by CodingLab |www.youtube.com/CodingLabYT-->
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    <link rel="icon" href="https://itc.edu.kh/wp-content/uploads/2021/02/logoitc.png" />

    <!-- Fonts -->
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/css/app.css'])
    <style>
        body {
            background: #e4e9f7;
        }
    </style>
</head>

<body>
    <div class="sidebar close">
        <div class="mt-2 pt-1 d-flex justify-content-center align-item-center">
            <img style="width: 2.2rem; margin: none;" src="https://itc.edu.kh/wp-content/uploads/2021/02/logoitc.png" alt="">
        </div>
        <ul class="nav-links ">
            <li class="{{ (request()->is('dashboard')) ? 'active' : '' }}">
                <a href="/dashboard">
                    <i class='bx bxs-dashboard'></i>
                    <span class="link_name">Dashboard</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="/dashboard">Dashboard</a></li>
                </ul>
            </li>
            <li class="{{ (request()->is('categories')) ? 'active' : '' }}">
                <a href="/categories">
                    <i class='bx bx-category'></i>
                    <span class="link_name">Categories</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="/categories">Category</a></li>
                </ul>
            </li>
            <li class="{{ request()->routeIs('items.*') ? 'active' : ''}}">
                <a href="/items">
                    <i class='bx bxs-folder-minus'></i>
                    <span class="link_name">Items</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="/items">Items</a></li>
                </ul>
            </li>
            <li class="{{ (request()->is('transactions')) ? 'active' : '' }}">
                <a href="/transactions">
                    <i class='bx bx-transfer'></i>
                    <span class="link_name">Transactions</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="/transactions">Transactions</a></li>
                </ul>
            </li>
            <li class="{{ (request()->is('buildings')) ? 'active' : '' }}">
                <a href="/buildings">
                    <i class='bx bx-building'></i>
                    <span class="link_name">Buildings</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="/buildings">Buildings</a></li>
                </ul>
            </li>
            <li class="{{ (request()->is('rooms')) ? 'active' : '' }}">
                <a href="/rooms">
                    <i class='bx bx-building-house'></i>
                    <span class="link_name">Rooms</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="/buildings">Rooms</a></li>
                </ul>
            </li>
            <li class="{{ request()->routeIs('employees.*') ? 'active' : ''}}">
                <a href="/employees">
                    <i class='bx bx-user-plus'></i>
                    <span class="link_name">Employee</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="/employees">Employee</a></li>
                </ul>
            </li>
            <li class="{{ (request()->is('sponsor')) ? 'active' : '' }}">
                <a href="/sponsor">
                    <i class='bx bxs-user-account'></i>
                    <span class="link_name">Sponsor</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="/sponsor">Sponsor</a></li>
                </ul>
            </li>
            <li class="{{ (request()->is('status')) ? 'active' : '' }}">
                <a href="/status">
                    <i class='bx bxs-star-half'></i>
                    <span class="link_name">Status</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="/status">Status</a></li>
                </ul>
            </li>
            <li class="{{ (request()->is('setting')) ? 'active' : '' }}">
                <a href="/setting">
                    <i class='bx bx-cog'></i>
                    <span class="link_name">Setting</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="/setting">Setting</a></li>
                </ul>
            </li>
            <li style="position: absolute; bottom:0% ; margin-bottom: 10px; width: calc(100% - 1px);">
                <div>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                      document.getElementById('logout-form').submit();">
                        <i style="font-size: 20px;" class="bx bx-log-out"></i>
                        <span class="link_name">Logout</span>
                    </a>
                    <ul class="sub-menu blank">
                        <li><a class="link_name" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                      document.getElementById('logout-form').submit();">Logout</a></li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
    <div class="home-section">
        <div class="app">
            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm p-0">
                <div class="home-content">
                    <i class="bx bx-menu"></i>
                    <span class="text">Inventory Management </span>
                </div>
                <div class="me-3 collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                        @if (Route::has('login'))
                        <li class="nav-item">
                            <!-- <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a> -->
                        </li>
                        @endif

                        @if (Route::has('register'))
                        <li class="nav-item">
                            <!-- <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a> -->
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="/profile">
                                {{ Auth::user()->name }}
                            </a>
<!-- 
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('login') }}">
                                    {{ __('Profile') }}
                                </a>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div> -->
                        </li>
                        @endguest
                    </ul>
                </div>
            </nav>
        </div>
        <div style="background: #e4e9f7;" class="mx-3 rounded">
            @yield('content')
        </div>
    </div>
    <script>
        let arrow = document.querySelectorAll(".arrow");
        for (var i = 0; i < arrow.length; i++) {
            arrow[i].addEventListener("click", (e) => {
                let arrowParent = e.target.parentElement.parentElement; //selecting main parent of arrow
                arrowParent.classList.toggle("showMenu");
            });
        }
        let sidebar = document.querySelector(".sidebar");
        let sidebarBtn = document.querySelector(".bx-menu");
        sidebarBtn.addEventListener("click", () => {
            sidebar.classList.toggle("close");
        });
    </script>
</body>

</html>