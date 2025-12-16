@extends('layouts.app')

@section('content')

<h3 class="mb-4">🎬 Yangi kino qo‘shish</h3>

<div class="card bg-dark text-light shadow-sm">
    <div class="card-body">
        <form method="POST" action="{{ route('movies.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="form-label">Nomi</label>
                <input type="text" name="title" class="form-control bg-secondary text-white" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Tavsif</label>
                <textarea name="description" class="form-control bg-secondary text-white" rows="4"></textarea>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Yil</label>
                    <input type="number" name="release_year" class="form-control bg-secondary text-white" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Davlat</label>
                    <input type="text" name="country" class="form-control bg-secondary text-white" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Poster</label>
                    <input type="file" name="poster_file" class="form-control bg-secondary text-white">
                    <small class="text-muted">JPG, PNG formatda yuklang</small>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Janrlar</label>
                <div class="d-flex flex-wrap">
                    @foreach($genres as $genre)
                        <div class="form-check me-3 mb-2">
                            <input class="form-check-input" type="checkbox" name="genres[]" value="{{ $genre->id }}" id="genre{{ $genre->id }}">
                            <label class="form-check-label" for="genre{{ $genre->id }}">
                                {{ $genre->name }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>

            <button class="btn btn-warning btn-lg mt-3">➕ Kinoni qo‘shish</button>
        </form>
    </div>
</div>

@endsection
