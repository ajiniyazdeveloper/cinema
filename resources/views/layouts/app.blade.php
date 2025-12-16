<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <title>KinoPlatforma</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #0d0d0d;
            color: #f1f1f1;
        }

        .navbar {
            border-bottom: 1px solid #444;
        }

        .navbar-brand span {
            letter-spacing: 1px;
        }

        .navbar-nav .nav-link {
            transition: color 0.2s;
        }

        .navbar-nav .nav-link:hover {
            color: #ffd700;
        }

        .dropdown-menu {
            border-radius: 8px;
            border: 1px solid #555;
        }

        .dropdown-item:hover {
            background-color: #222 !important;
            color: #ffd700 !important;
        }

        .btn-warning {
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .btn-warning:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 193, 7, 0.4);
        }

        .btn-danger:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(220, 53, 69, 0.4);
        }

        .sticky-top {
            z-index: 1020;
        }



        .movie-card {
            background-color: #1a1a1a;
            border-radius: 10px;
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .movie-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(255, 255, 255, 0.2);
        }

        .movie-card img {
            width: 100%;
            height: 400px;
            object-fit: cover;
        }

        .movie-card-body {
            padding: 15px;
        }

        .badge-genre {
            background-color: #ffd700;
            color: #111;
            margin-right: 5px;
            font-weight: 500;
        }

        .rating-stars {
            color: #ffd700;
        }

        .footer {
            background-color: #111111;
            color: #888;
            text-align: center;
            padding: 20px;
            margin-top: auto; /* Shu eng muhim */
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm sticky-top">
    <div class="container">

        {{-- Logo / Brand --}}
        <a class="navbar-brand fw-bold fs-4 d-flex align-items-center" href="{{ route('movies.index') }}">
            🎬 <span class="ms-2">KinoPlatforma</span>
        </a>

        {{-- Hamburger for mobile --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- Navbar links --}}
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">

                {{-- Admin - Kino qo‘shish --}}
                @auth
                    @if(auth()->user()->is_admin)
                        <li class="nav-item me-2">
                            <a href="{{ route('movies.create') }}" class="btn btn-warning btn-sm fw-bold">
                                ➕ Kino qo‘shish
                            </a>
                        </li>
                    @endif

                    {{-- Foydalanuvchi dropdown --}}
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle fw-bold text-white" href="#" role="button" 
                           data-bs-toggle="dropdown" aria-expanded="false">
                            👤 {{ auth()->user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end bg-dark">
                            <li>
                                <a class="dropdown-item text-light" href="{{ route('profile.show') }}">
                                    📝 Profil
                                </a>
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-light">
                                        🔒 Chiqish
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>

                @else
                    <li class="nav-item">
                        <a class="btn btn-sm btn-primary fw-bold" href="{{ route('login') }}">
                            🔑 Kirish
                        </a>
                    </li>
                @endauth

            </ul>
        </div>
    </div>
</nav>



<div class="container mt-4 flex-grow-1">
    @yield('content')
</div>

<div class="footer">
    &copy; {{ date('Y') }} KinoPlatforma. Barcha huquqlar himoyalangan.
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
