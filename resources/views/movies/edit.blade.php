@extends('layouts.app')

@section('content')

<h3 class="mb-4">✏️ Kinoni tahrirlash</h3>

<div class="card bg-dark text-light shadow-sm">
    <div class="card-body">
        <form method="POST" action="{{ route('movies.update', $movie->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Nomi</label>
                <input type="text" name="title" class="form-control bg-secondary text-white" 
                       value="{{ $movie->title }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Tavsif</label>
                <textarea name="description" class="form-control bg-secondary text-white" rows="4">{{ $movie->description }}</textarea>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Yil</label>
                    <input type="number" name="release_year" class="form-control bg-secondary text-white" 
                           value="{{ $movie->release_year }}" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Davlat</label>
                    <input type="text" name="country" class="form-control bg-secondary text-white" 
                           value="{{ $movie->country }}" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Poster</label>
                    <input type="file" name="poster_file" class="form-control bg-secondary text-white">
                    @if($movie->poster)
                        <img src="{{ asset($movie->poster) }}" alt="Poster" class="img-fluid mt-2 rounded" style="height:150px;">
                    @endif
                    <small class="text-muted d-block">JPG, PNG formatda yuklang</small>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Janrlar</label>
                <div class="d-flex flex-wrap">
                    @foreach($genres as $genre)
                        <div class="form-check me-3 mb-2">
                            <input class="form-check-input" type="checkbox" name="genres[]" value="{{ $genre->id }}" 
                                   id="genre{{ $genre->id }}" 
                                   @checked($movie->genres->contains($genre->id))>
                            <label class="form-check-label" for="genre{{ $genre->id }}">
                                {{ $genre->name }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>

            <button class="btn btn-warning btn-lg mt-3">💾 Saqlash</button>
        </form>
    </div>
</div>

@endsection
