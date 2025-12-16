@extends('layouts.app')

@section('content')

<h2 class="mb-4">🎥 Eng so‘ngi filmlar</h2>
{{-- FILTER FORM --}}
<form method="GET" class="row g-3 mb-4 filter-form p-3 rounded shadow-sm bg-dark text-light">

    <div class="col-md-3">
        <select name="genre_id" class="form-select bg-secondary text-white">
            <option value="">🎭 Janr tanlang</option>
            @foreach($genres as $genre)
                <option value="{{ $genre->id }}" @selected(request('genre_id') == $genre->id)>
                    {{ $genre->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-2">
        <input type="number" name="year" class="form-control bg-secondary text-white" placeholder="📅 Yil"
               value="{{ request('year') }}">
    </div>

    <div class="col-md-3">
        <input type="text" name="country" class="form-control bg-secondary text-white" placeholder="🌍 Davlat"
               value="{{ request('country') }}">
    </div>

    <div class="col-md-2">
        <select name="sort" class="form-select bg-secondary text-white">
            <option value="">↕️ Tartiblash</option>
            <option value="rating" @selected(request('sort') == 'rating')>
                ⭐ Reyting bo‘yicha
            </option>
        </select>
    </div>

    <div class="col-md-2">
        <button class="btn btn-primary w-100">Filtrlash</button>
    </div>

</form>

<div class="row g-4">
    @foreach($movies as $movie)
        <div class="col-md-3">
            <div class="movie-card">
                <img src="{{ $movie->poster }}" alt="{{ $movie->title }}">
                <div class="movie-card-body">
                    <h5>{{ $movie->title }}</h5>
                    <p class="text-white">{{ $movie->release_year }} | {{ $movie->country }}</p>
                    <p>
                        @foreach($movie->genres as $genre)
                            <span class="badge badge-genre">{{ $genre->name }}</span>
                        @endforeach
                    </p>
                    <p class="rating-stars">⭐ {{ number_format($movie->averageRating(), 1) }}</p>
                    <a href="{{ route('movies.show', $movie->id) }}" class="btn btn-outline-warning btn-sm w-100">
                        Batafsil
                    </a>
                </div>
            </div>
        </div>
    @endforeach
</div>
<style>
    .filter-form {
        border: 1px solid #444;
        border-radius: 12px;
        background-color: #1a1a1a;
    }

    .filter-form .form-control,
    .filter-form .form-select {
        border-radius: 8px;
        border: 1px solid #555;
        transition: all 0.3s;
    }

    .filter-form .form-control:focus,
    .filter-form .form-select:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 8px rgba(13,110,253,0.3);
        background-color: #2a2a2a;
        color: #fff;
    }

    .filter-form button {
        font-weight: 600;
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .filter-form button:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.3);
    }

</style>
@endsection
