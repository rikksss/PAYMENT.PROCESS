<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LazaPee</title>

    <!-- Use Laravel's asset helper to load CSS -->
    <!-- Bootstrap Bundle (includes Popper.js) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/stylesheet.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
</head>

<body id="body-pd">

    <!-- Sidebar -->
    <div class="l-navbar" id="nav-bar">
        <nav class="nav">
            <div>
                <!-- Logo Section -->
                <a href="#" class="nav_logo">
                    <div class="header_logo_img">
                        
                    </div>
                    <i class="bx bx-market nav_icon"></i>
                    <span class="nav_logo-name">LazaPee</span>
                </a>
                
                <!-- Sidebar Navigation Links -->
                <div class="nav_list">
                    <a href="{{ route('dashboard.content') }}" class="nav_link {{ Request::routeIs('dashboard.content') ? 'active' : '' }}">
                        <i class="bx bx-home nav_icon"></i>
                        <span class="nav_name">Dashboard</span>
                    </a>

                    <a href="{{ route('users.index') }}" class="nav_link {{ Request::routeIs('users.index') ? 'active' : '' }}">
                        <i class="bx bx-user nav_icon"></i>
                        <span class="nav_name">Manage Users</span>
                    </a>

                    <a href="{{ route('products.index') }}" class="nav_link">
                        <i class="bx bx-cube nav_icon"></i>
                        <span class="nav_name">Products</span>
                    </a>

                    <a href="{{ route('category.index') }}" class="nav_link">
                        <i class="bx bx-category nav_icon"></i>
                        <span class="nav_name">Categories</span>
                    </a>

                    <a href="#" class="nav_link">
                        <i class="bx bx-credit-card nav_icon"></i>
                        <span class="nav_name">Payment</span>
                    </a>

                    <a href="#" class="nav_link">
                        <i class="bx bx-cogs nav_icon"></i>
                        <span class="nav_name">Settings</span>
                    </a>

                    <a href="{{ route('analytics.content') }}" class="nav_link{{ Request::routeIs('analytics.content') ? 'active' : '' }}">
                        <i class="bx bx-bar-chart-alt-2 nav_icon"></i>
                        <span class="nav_name">Analytics</span>
                    </a>

                    <a href="{{ route('auth.login') }}" class="nav_link {{ Request::routeIs('auth.login') ? 'active' : '' }}">
                        <i class="bx bx-log-out nav_icon"></i>
                        <span class="nav_name">SignOut</span>
                       
                    </a>
                </div>
            </div>
        </nav>
    </div>

    <!-- Content Area -->
    <div id="content" class="height-100 bg-light">
        @yield('content')
    </div>

    <!-- JS to Toggle Sidebar -->
    <script>
        const headerToggle = document.getElementById('header-toggle');
        const navBar = document.getElementById('nav-bar');
        const viewport = document.getElementById('content');

        headerToggle.addEventListener('click', () => {
            navBar.classList.toggle('active');
            viewport.classList.toggle('active');
        });
    </script>

</body>
</html>