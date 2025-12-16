<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <title>Kino Platforma</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ route('movies.index') }}">🎬 KinoPlatforma</a>

        <ul class="navbar-nav ms-auto">
            @auth
                <li class="nav-item">
                    <span class="nav-link">{{ auth()->user()->name }}</span>
                </li>
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="btn btn-sm btn-danger">Chiqish</button>
                    </form>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Kirish</a>
                </li>
            @endauth
        </ul>
    </div>
</nav>

<div class="container mt-4">
    @yield('content')
</div>

</body>
</html>
