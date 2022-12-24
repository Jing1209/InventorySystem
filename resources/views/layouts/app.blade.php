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
</head>

<body>
    <div class="sidebar close">
        <div class="mt-2 pt-1 d-flex justify-content-center align-item-center">
            <img style="width: 2.2rem; margin: none;" src="https://itc.edu.kh/wp-content/uploads/2021/02/logoitc.png" alt="">
        </div>
        <ul class="nav-links ">
            <li>
                <a href="/dashboard">
                    <i class='bx bxs-dashboard'></i>
                    <span class="link_name">Dashboard</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="/dashboard">Dashboard</a></li>
                </ul>
            </li>
            <li>
                <a href="/categories">
                    <i class='bx bx-category'></i>
                    <span class="link_name">Categories</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="/categories">Category</a></li>
                </ul>
            </li>
            <li>
                <a href="/items">
                    <i class='bx bxs-folder-minus'></i>
                    <span class="link_name">Items</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="/items">Items</a></li>
                </ul>
            </li>
            <li>
                <a href="/transactions">
                    <i class='bx bx-transfer'></i>
                    <span class="link_name">Transactions</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="/transactions">Transactions</a></li>
                </ul>
            </li>
            <li>
                <a href="/buildings">
                    <i class='bx bx-building-house'></i>
                    <span class="link_name">Buildings</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="/buildings">Buildings</a></li>
                </ul>
            </li>
            <li>
                <a href="/rooms">
                    <i class='bx bx-building'></i>
                    <span class="link_name">Rooms</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="/buildings">Rooms</a></li>
                </ul>
            </li>
            <li>
                <a href="/setting">
                    <i class='bx bx-cog'></i>
                    <span class="link_name">Setting</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="/setting">Setting</a></li>
                </ul>
            </li>
            <li>
                <a class="mb-4 fixed-bottom" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                      document.getElementById('logout-form').submit();">
                    <i style="font-size: 20px;" class="bx bx-log-out"></i>
                    <span class="link_name">Logout</span>
                </a>
            </li>
        </ul>
    </div>
    <section class="home-section">
        <div class="navbar d-flex justify-content-between w-100 navbar-expand-md navbar-light bg-white shadow-sm p-0 position-fixed overflow-hidden">
            <div class="home-content">
                <i class="bx bx-menu"></i>
                <span class="text">Inventory Management </span>
            </div>
            <div >
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="/profile">
                            {{ Auth::user()->name }}
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="mx-3 my-2 mh-75 rounded" style="height: 100vh;">
            @yield('content')
        </div>
    </section>
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