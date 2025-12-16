@extends('layouts.app')

@section('content')

<h2 class="mb-4">🎥 Filmlar va Seriallar</h2>

{{-- FILTER FORM --}}
<form method="GET" class="row g-3 mb-4">

    <div class="col-md-3">
        <select name="genre_id" class="form-select">
            <option value="">🎭 Janr tanlang</option>
            @foreach($genres as $genre)
                <option value="{{ $genre->id }}" @selected(request('genre_id') == $genre->id)>
                    {{ $genre->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-2">
        <input type="number" name="year" class="form-control" placeholder="📅 Yil"
               value="{{ request('year') }}">
    </div>

    <div class="col-md-3">
        <input type="text" name="country" class="form-control" placeholder="🌍 Davlat"
               value="{{ request('country') }}">
    </div>

    <div class="col-md-2">
        <select name="sort" class="form-select">
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

{{-- MOVIE LIST --}}
<div class="row">
    @forelse($movies as $movie)
        <div class="col-md-3 mb-4">
            <div class="card h-100 shadow-sm">

                <img src="{{ $movie->poster ?? 'https://via.placeholder.com/300x400' }}"
                     class="card-img-top" alt="{{ $movie->title }}">

                <div class="card-body">
                    <h5 class="card-title">{{ $movie->title }}</h5>

                    <p class="text-muted mb-1">
                        {{ $movie->release_year }} | {{ $movie->country }}
                    </p>

                    <p class="mb-1">
                        ⭐ {{ number_format($movie->averageRating(), 1) ?? '0.0' }}
                    </p>

                    <a href="{{ route('movies.show', $movie->id) }}"
                       class="btn btn-sm btn-outline-primary w-100">
                        Batafsil
                    </a>
                </div>

            </div>
        </div>
    @empty
        <p>Hech qanday film topilmadi 😕</p>
    @endforelse
</div>

{{ $movies->links() }}

@endsection
