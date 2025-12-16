@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-4">

        <h3 class="mb-4 text-center">🔐 Tizimga kirish</h3>

        @if($errors->any())
            <div class="alert alert-danger">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Parol</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <button class="btn btn-primary w-100">Kirish</button>
        </form>

        <p class="text-center mt-3">
            Akkauntingiz yo‘qmi?
            <a href="{{ route('register') }}">Ro‘yxatdan o‘tish</a>
        </p>

    </div>
</div>

@endsection
