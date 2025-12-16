@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-4">
        <img src="{{ $movie->poster ?? 'https://via.placeholder.com/300x400' }}"
             class="img-fluid rounded shadow">
    </div>

    <div class="col-md-8">
        <h2>{{ $movie->title }}</h2>

        <p class="text-muted">
            {{ $movie->release_year }} | {{ $movie->country }}
        </p>

        <p>
            <strong>Janrlar:</strong>
            @foreach($movie->genres as $genre)
                <span class="badge bg-secondary">{{ $genre->name }}</span>
            @endforeach
        </p>

        <p>{{ $movie->description }}</p>

        <h5>⭐ O‘rtacha reyting: {{ number_format($movie->averageRating(), 1) }}</h5>

        <hr>

        {{-- RATING FORM --}}
        @auth
            <form method="POST" action="{{ route('movies.rate', $movie->id) }}">
                @csrf
                <label>Reyting bering (1–5):</label>
                <select name="rating" class="form-select w-25 mb-2">
                    @for($i=1;$i<=5;$i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>

                <button class="btn btn-success">Yuborish</button>
            </form>
        @else
            <p class="text-danger">
                Reyting berish uchun <a href="{{ route('login') }}">tizimga kiring</a>
            </p>
        @endauth
    </div>
</div>

@endsection
