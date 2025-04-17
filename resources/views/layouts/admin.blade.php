<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin Dashboard - Haz Creatives Studio')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- AOS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        :root {
            --admin-bg: #0a0a0a;
            --sidebar-bg: #1a1a1a;
            --card-bg: #242424;
            --text-primary: #ffffff;
            --text-secondary: rgba(255, 255, 255, 0.7);
            --text-muted: rgba(255, 255, 255, 0.5);
            --border-color: rgba(255, 255, 255, 0.1);
            --hover-bg: rgba(255, 255, 255, 0.1);
        }

        body {
            background-color: var(--admin-bg);
            min-height: 100vh;
            color: var(--text-primary);
        }

        /* Text Colors */
        .text-white {
            color: var(--text-primary) !important;
        }

        .text-secondary {
            color: var(--text-secondary) !important;
        }

        .text-muted {
            color: var(--text-muted) !important;
        }

        /* Card Styles */
        .card {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
        }

        .card-title {
            color: var(--text-primary);
        }

        .card-subtitle {
            color: var(--text-secondary);
        }

        .card-header {
            background: var(--card-bg);
            border-bottom: 1px solid var(--border-color);
            color: var(--text-primary);
        }

        .list-group-item {
            background: var(--card-bg);
            border-color: var(--border-color);
            color: var(--text-primary);
        }

        /* Stats Numbers */
        .card-title.stats-number {
            font-size: 2.5rem;
            font-weight: 600;
            color: var(--text-primary);
        }

        /* Sidebar Styles */
        .admin-sidebar {
            background: var(--sidebar-bg);
            min-height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            width: 250px;
            padding: 20px;
            border-right: 1px solid var(--border-color);
        }

        .admin-content {
            margin-left: 250px;
            padding: 20px;
        }

        .admin-sidebar .nav-link {
            color: var(--text-secondary);
            padding: 10px 15px;
            border-radius: 5px;
            margin-bottom: 5px;
            transition: all 0.3s;
        }

        .admin-sidebar .nav-link:hover {
            background: var(--hover-bg);
            color: var(--text-primary);
        }

        .admin-sidebar .nav-link.active {
            background: var(--hover-bg);
            color: var(--text-primary);
        }

        .admin-sidebar .nav-link i {
            width: 20px;
            text-align: center;
            margin-right: 10px;
        }

        .admin-logo {
            padding: 20px 0;
            margin-bottom: 20px;
            border-bottom: 1px solid var(--border-color);
        }

        .admin-logo a {
            color: var(--text-primary);
            font-size: 1.25rem;
            font-weight: 500;
        }

        .admin-user {
            padding: 15px 0;
            margin-top: auto;
            border-top: 1px solid var(--border-color);
            color: var(--text-primary);
        }

        /* Button Styles */
        .btn-outline-light {
            border-color: var(--border-color);
            color: var(--text-primary);
        }

        .btn-outline-light:hover {
            background: var(--hover-bg);
            border-color: var(--text-secondary);
            color: var(--text-primary);
        }

        /* Dropdown Styles */
        .dropdown-menu {
            background: var(--card-bg);
            border-color: var(--border-color);
        }

        .dropdown-item {
            color: var(--text-secondary);
        }

        .dropdown-item:hover {
            background: var(--hover-bg);
            color: var(--text-primary);
        }

        .dropdown-divider {
            border-color: var(--border-color);
        }

        @media (max-width: 768px) {
            .admin-sidebar {
                width: 70px;
                padding: 10px;
            }

            .admin-content {
                margin-left: 70px;
            }

            .admin-sidebar .nav-link span,
            .admin-sidebar .admin-logo span {
                display: none;
            }

            .admin-sidebar .nav-link i {
                margin: 0;
                font-size: 1.2em;
            }
        }
    </style>
</head>

<body>
    <!-- Admin Sidebar -->
    <div class="admin-sidebar d-flex flex-column">
        <div class="admin-logo">
            <a href="{{ route('dashboard') }}" class="text-decoration-none">
                <i class="fas fa-camera-retro"></i>
                <span class="ms-2">Haz Creatives</span>
            </a>
        </div>

        <nav class="nav flex-column mb-auto">
            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="fas fa-home"></i>
                <span>Dashboard</span>
            </a>
            <a href="#" class="nav-link">
                <i class="fas fa-images"></i>
                <span>Gallery</span>
            </a>
            <a href="#" class="nav-link">
                <i class="fas fa-envelope"></i>
                <span>Messages</span>
            </a>
            <a href="#" class="nav-link">
                <i class="fas fa-cog"></i>
                <span>Settings</span>
            </a>
            <a href="{{ route('home') }}" class="nav-link" target="_blank">
                <i class="fas fa-external-link-alt"></i>
                <span>View Site</span>
            </a>
        </nav>

        <div class="admin-user">
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle"
                    id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="https://github.com/mdo.png" alt="" width="32" height="32"
                        class="rounded-circle me-2">
                    <span>{{ Auth::user()->name }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="userDropdown">
                    <li><a class="dropdown-item" href="#">Profile</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item">Sign out</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="admin-content">
        <!-- Top Header Bar -->
        <div class="admin-header mb-4">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="m-0">@yield('header', '')</h2>
                <a href="{{ route('home') }}" class="btn btn-outline-light" target="_blank">
                    <i class="fas fa-external-link-alt me-2"></i>View Website
                </a>
            </div>
        </div>
        @yield('content')
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AOS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>

</html>
