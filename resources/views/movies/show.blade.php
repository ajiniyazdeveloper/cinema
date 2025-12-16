@extends('layouts.app')

@section('content')

<div class="row g-4">

    {{-- Poster --}}
    <div class="col-md-4">
        <div class="card movie-card shadow-sm mb-3">
            @if($movie->poster)
                <img src="{{ asset($movie->poster) }}" alt="{{ $movie->title }}">
            @else
                <img src="https://via.placeholder.com/400x600?text=Poster+Yo'q" alt="No Poster">
            @endif
        </div>
    </div>

    {{-- Kino ma'lumotlari --}}
    <div class="col-md-8 text-light">
        <h2 class="mb-2">{{ $movie->title }}</h2>

        <p class="text-white mb-2">
            {{ $movie->release_year }} | {{ $movie->country }}
        </p>

        <p class="mb-2">
            <strong>Janrlar:</strong>
            @foreach($movie->genres as $genre)
                <span class="badge badge-genre">{{ $genre->name }}</span>
            @endforeach
        </p>

        <p class="mb-3">{{ $movie->description }}</p>

        <h5 class="rating-stars mb-3">⭐ O‘rtacha reyting: {{ number_format($movie->averageRating(), 1) }}</h5>

        <hr class="border-light">

        {{-- Interaktiv yulduz reyting --}}
        @auth
        <div class="mb-4">
            <label class="form-label">Sizning reytingingiz:</label>
            <form method="POST" action="{{ route('movies.rate', $movie->id) }}" class="d-flex align-items-center">
                @csrf
                <div class="star-rating me-2">
                    @for($i=1; $i<=5; $i++)
                        <span class="star" data-value="{{ $i }}">&#9733;</span>
                    @endfor
                </div>
                <input type="hidden" name="rating" id="rating-value" value="0">
                <button class="btn btn-success">Yuborish</button>
            </form>
        </div>
        @else
        <p class="text-danger">
            Reyting berish uchun <a href="{{ route('login') }}" class="text-warning">tizimga kiring</a>
        </p>
        @endauth

        {{-- Admin tugmalari --}}
        @auth
            @if(auth()->user()->is_admin)
                <div class="mt-3">
                    <a href="{{ route('movies.edit', $movie->id) }}" class="btn btn-warning me-2 mb-2">
                        ✏️ Kinoni tahrirlash
                    </a>

                    <form action="{{ route('movies.destroy', $movie->id) }}" method="POST" class="d-inline"
                        onsubmit="return confirm('Rostdan ham bu kinoni o‘chirmoqchimisiz?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger mb-2">🗑 O‘chirish</button>
                    </form>
                </div>
            @endif
        @endauth
    </div>
</div>

{{-- CSS --}}
<style>
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
    height: 600px;
    object-fit: cover;
}

.badge-genre {
    background-color: #ffd700;
    color: #111;
    margin-right: 5px;
    font-weight: 500;
}

.rating-stars {
    color: #ffd700;
    font-size: 1.2rem;
}

.star-rating {
    font-size: 2rem;
    color: #ddd;
    cursor: pointer;
}

.star-rating .star:hover,
.star-rating .star.hover,
.star-rating .star.selected {
    color: #ffd700;
}
</style>

{{-- JS --}}
<script>
document.addEventListener('DOMContentLoaded', () => {
    const stars = document.querySelectorAll('.star-rating .star');
    const ratingInput = document.getElementById('rating-value');

    stars.forEach((star, index) => {
        star.addEventListener('mouseover', () => {
            stars.forEach((s, i) => {
                s.classList.toggle('hover', i <= index);
            });
        });

        star.addEventListener('mouseout', () => {
            stars.forEach(s => s.classList.remove('hover'));
        });

        star.addEventListener('click', () => {
            stars.forEach((s, i) => {
                s.classList.toggle('selected', i <= index);
            });
            ratingInput.value = index + 1;
        });
    });
});
</script>

@endsection
